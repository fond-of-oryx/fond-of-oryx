<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Business\Calculator;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\JellyfishProportionalCouponValueTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;

class ProportionalGiftCardAmountCalculator implements ProportionalGiftCardAmountCalculatorInterface
{
    /**
     * @var array
     */
    protected const EXPENSE_MAPPING = ['SHIPMENT_EXPENSE_TYPE' => 'freight'];

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderNoPaymentGiftCardConnector\Dependency\Facade\JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface $salesFacade
     */
    public function __construct(
        JellyfishSalesOrderNoPaymentGiftCardConnectorToSalesFacadeInterface $salesFacade
    ) {
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

        $giftCardBalances = $this->getJellyfishGiftCardBalances($orderTransfer);

        $usedBalances = [];

        foreach ($giftCardBalances as $balance) {
            $usedBalances = $this->handleItems($jellyfishOrderTransfer, $balance, $usedBalances);
            $usedBalances = $this->handleExpenses($jellyfishOrderTransfer, $balance, $usedBalances);
        }

        return $jellyfishOrderTransfer->setGiftCardBalances($giftCardBalances);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function getJellyfishGiftCardBalances(OrderTransfer $orderTransfer): ArrayObject
    {
        $items = $this->prepareItems($orderTransfer);
        $expenses = $this->prepareExpenses($orderTransfer);

        return new ArrayObject(array_merge($items, $expenses));
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function prepareItems(OrderTransfer $orderTransfer): array
    {
        $collection = [];

        foreach ($orderTransfer->getItems() as $itemTransfer) {
            $idSalesOrderItem = $itemTransfer->getIdSalesOrderItem();

            if (isset($collection[$idSalesOrderItem])) {
                continue;
            }

            $itemBalance = (new ProportionalGiftCardValueTransfer())
                ->setValue(
                    $itemTransfer->getUnitPriceToPayAggregation(),
                )
                ->setFkSalesOrderItem($idSalesOrderItem)
                ->setFkSalesOrder($orderTransfer->getIdSalesOrder())
                ->setOrderReference($orderTransfer->getOrderReference())
                ->setSku($itemTransfer->getSku());

            $collection[$idSalesOrderItem] = $itemBalance;
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function prepareExpenses(OrderTransfer $orderTransfer): array
    {
        $collection = [];

        foreach ($orderTransfer->getExpenses() as $expenseTransfer) {
            $idSalesExpense = $expenseTransfer->getIdSalesExpense();
            $expenseType = $expenseTransfer->getType();

            if (
                !isset(static::EXPENSE_MAPPING[$expenseType]) || isset($collection[$idSalesExpense])
            ) {
                continue;
            }

            $itemBalance = (new ProportionalGiftCardValueTransfer())
                ->setValue(
                    $expenseTransfer->getSumGrossPrice(),
                )
                ->setFkSalesExpense($idSalesExpense)
                ->setFkSalesOrder($orderTransfer->getIdSalesOrder())
                ->setOrderReference($orderTransfer->getOrderReference())
                ->setSku(static::EXPENSE_MAPPING[$expenseType]);

            $collection[$idSalesExpense] = $itemBalance;
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
