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
        $idSalesOrder = $orderTransfer->getIdSalesOrder();
        $orderReference = $orderTransfer->getOrderReference();
        foreach ($recalculatedOrderTransfer->getItems() as $recalculatedOrderItemTransfer) {
            foreach ($orderTransfer->getItems() as $orderItemTransfer) {
                $idSaledOrderItem = $orderItemTransfer->getIdSalesOrderItem();
                if (array_key_exists($idSaledOrderItem, $collection) === false && $recalculatedOrderItemTransfer->getIdSalesOrderItem() === $idSaledOrderItem) {
                    $proportionalValue = $orderItemTransfer->getUnitPriceToPayAggregation() - $recalculatedOrderItemTransfer->getUnitPriceToPayAggregation();
                    $itemBalance = (new ProportionalGiftCardValueTransfer())
                        ->setValue($proportionalValue)
                        ->setFkSalesOrderItem($idSaledOrderItem)
                        ->setFkSalesOrder($idSalesOrder)
                        ->setOrderReference($orderReference)
                        ->setSku($orderItemTransfer->getSku());
                    $collection[] = $itemBalance;
                }
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
        $idSalesOrder = $orderTransfer->getIdSalesOrder();
        $orderReference = $orderTransfer->getOrderReference();
        foreach ($recalculatedOrderTransfer->getExpenses() as $recalculatedExpenses) {
            foreach ($orderTransfer->getExpenses() as $orderExpenseTransfer) {
                $idSalesExpense = $orderExpenseTransfer->getIdSalesExpense();
                if (array_key_exists($idSalesExpense, $collection) === false && $recalculatedExpenses->getIdSalesExpense() === $idSalesExpense) {
                    $proportionalValue = $orderExpenseTransfer->getSumGrossPrice() - $recalculatedExpenses->getSumGrossPrice();
                    $itemBalance = (new ProportionalGiftCardValueTransfer())
                        ->setValue($proportionalValue)
                        ->setFkSalesExpense($idSalesExpense)
                        ->setFkSalesOrder($idSalesOrder)
                        ->setOrderReference($orderReference)
                        ->setSku(static::EXPENSE_MAPPING[$orderExpenseTransfer->getType()]);
                    $collection[] = $itemBalance;
                }
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
            if (array_key_exists($idSalesOrderItem, $usedBalances) === false && $item->getSku() === $balance->getSku()) {
                $usedBalances[$idSalesOrderItem] = $balance;
                $proportionalCouponValue = (new JellyfishProportionalCouponValueTransfer())
                    ->setAmount($balance->getValue())
                    ->setIdSalesOrderItem($idSalesOrderItem);
                $item->addProportionalCouponValue($proportionalCouponValue);
            }
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
            $identifier = $idSalesExpense . $expense->getType();
            if (array_key_exists($identifier, $usedBalances) === false && array_key_exists($expense->getType(), static::EXPENSE_MAPPING) && static::EXPENSE_MAPPING[$expense->getType()] === $balance->getSku()) {
                $usedBalances[$identifier] = $balance;
                $proportionalCouponValue = (new JellyfishProportionalCouponValueTransfer())
                    ->setAmount($balance->getValue());
                $expense->addProportionalCouponValue($proportionalCouponValue);
            }
        }

        return $usedBalances;
    }
}
