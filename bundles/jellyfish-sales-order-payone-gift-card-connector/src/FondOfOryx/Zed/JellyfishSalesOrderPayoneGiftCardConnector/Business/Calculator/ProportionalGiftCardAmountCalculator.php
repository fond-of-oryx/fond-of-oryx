<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Calculator;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\JellyfishProportionalCouponValueTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use function DeepCopy\deep_copy;

class ProportionalGiftCardAmountCalculator implements ProportionalGiftCardAmountCalculatorInterface
{
    /**
     * @var array
     */
    protected const EXPENSE_MAPPING = ['SHIPMENT_EXPENSE_TYPE' => 'freight'];

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface
     */
    protected $payoneService;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface $payoneService
     * @param \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface $salesFacade
     */
    public function __construct(
        JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface $payoneService,
        JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeInterface $salesFacade
    ) {
        $this->payoneService = $payoneService;
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function calculate(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        int $idSalesOrder
    ): JellyfishOrderTransfer {
        $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($idSalesOrder);
        $recalculatedOrderTransfer = $this->payoneService->distributeOrderPrice(deep_copy($orderTransfer));

        $giftCardBalances = $this->getJellyfishGiftCardBalances($recalculatedOrderTransfer, $orderTransfer);

        $usedBalances = [];

        foreach ($giftCardBalances as $balance) {
            $usedBalances = $this->handleItems($jellyfishOrderTransfer, $balance, $usedBalances);
            $usedBalances = $this->handleExpenses($jellyfishOrderTransfer, $balance, $usedBalances);
        }

        return $jellyfishOrderTransfer->setGiftCardBalances($giftCardBalances);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $recalculatedOrderTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function getJellyfishGiftCardBalances(OrderTransfer $recalculatedOrderTransfer, OrderTransfer $orderTransfer): ArrayObject
    {
        $items = $this->prepareItems($recalculatedOrderTransfer, $orderTransfer);
        $expenses = $this->prepareExpenses($recalculatedOrderTransfer, $orderTransfer);

        return new ArrayObject(array_merge($items, $expenses));
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $recalculatedOrderTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function prepareItems(OrderTransfer $recalculatedOrderTransfer, OrderTransfer $orderTransfer): array
    {
        $collection = [];

        foreach ($recalculatedOrderTransfer->getItems() as $recalculatedItemTransfer) {
            foreach ($orderTransfer->getItems() as $itemTransfer) {
                $idSalesOrderItem = $itemTransfer->getIdSalesOrderItem();
                $recalculatedIdSalesOrderItem = $recalculatedItemTransfer->getIdSalesOrderItem();

                if (isset($collection[$idSalesOrderItem]) || $idSalesOrderItem !== $recalculatedIdSalesOrderItem) {
                    continue;
                }

                $itemBalance = (new ProportionalGiftCardValueTransfer())
                    ->setValue(
                        $itemTransfer->getUnitPriceToPayAggregation() - $recalculatedItemTransfer->getUnitPriceToPayAggregation(),
                    )
                    ->setFkSalesOrderItem($idSalesOrderItem)
                    ->setFkSalesOrder($orderTransfer->getIdSalesOrder())
                    ->setOrderReference($orderTransfer->getOrderReference())
                    ->setSku($itemTransfer->getSku());

                $collection[$idSalesOrderItem] = $itemBalance;
            }
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $recalculatedOrderTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function prepareExpenses(OrderTransfer $recalculatedOrderTransfer, OrderTransfer $orderTransfer): array
    {
        $collection = [];

        foreach ($recalculatedOrderTransfer->getExpenses() as $recalculatedExpenseTransfer) {
            foreach ($orderTransfer->getExpenses() as $expenseTransfer) {
                $idSalesExpense = $expenseTransfer->getIdSalesExpense();
                $recalculatedIdSalesExpense = $recalculatedExpenseTransfer->getIdSalesExpense();
                $expenseType = $expenseTransfer->getType();

                if (
                    !isset(static::EXPENSE_MAPPING[$expenseType]) || isset($collection[$idSalesExpense])
                    || $idSalesExpense !== $recalculatedIdSalesExpense
                ) {
                    continue;
                }

                $itemBalance = (new ProportionalGiftCardValueTransfer())
                    ->setValue(
                        $expenseTransfer->getSumGrossPrice() - $recalculatedExpenseTransfer->getSumGrossPrice(),
                    )
                    ->setFkSalesExpense($idSalesExpense)
                    ->setFkSalesOrder($orderTransfer->getIdSalesOrder())
                    ->setOrderReference($orderTransfer->getOrderReference())
                    ->setSku(static::EXPENSE_MAPPING[$expenseType]);

                $collection[$idSalesExpense] = $itemBalance;
            }
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $balance
     * @param array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $usedBalances
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function handleItems(JellyfishOrderTransfer $jellyfishOrderTransfer, ProportionalGiftCardValueTransfer $balance, array $usedBalances): array
    {
        foreach ($jellyfishOrderTransfer->getItems() as $item) {
            $idSalesOrderItem = $balance->getFkSalesOrderItem();

            if ($idSalesOrderItem === null) {
                continue;
            }

            if (isset($usedBalances[$idSalesOrderItem]) || $item->getSku() !== $balance->getSku()) {
                continue;
            }

            $usedBalances[$idSalesOrderItem] = $balance;

            $proportionalCouponValue = (new JellyfishProportionalCouponValueTransfer())
                ->setAmount($balance->getValue())
                ->setIdSalesOrderItem($idSalesOrderItem);

            $item->addProportionalCouponValue($proportionalCouponValue);
        }

        return $usedBalances;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $balance
     * @param array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $usedBalances
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function handleExpenses(JellyfishOrderTransfer $jellyfishOrderTransfer, ProportionalGiftCardValueTransfer $balance, array $usedBalances): array
    {
        foreach ($jellyfishOrderTransfer->getExpenses() as $expense) {
            $idSalesExpense = $balance->getFkSalesExpense();

            if ($idSalesExpense === null) {
                continue;
            }

            $expenseType = $expense->getType();
            $identifier = $idSalesExpense . $expenseType;

            if (isset($usedBalances[$identifier]) || !isset(static::EXPENSE_MAPPING[$expenseType]) || static::EXPENSE_MAPPING[$expenseType] !== $balance->getSku()) {
                continue;
            }

            $usedBalances[$identifier] = $balance;

            $proportionalCouponValue = (new JellyfishProportionalCouponValueTransfer())
                ->setAmount($balance->getValue());

            $expense->addProportionalCouponValue($proportionalCouponValue);
        }

        return $usedBalances;
    }
}
