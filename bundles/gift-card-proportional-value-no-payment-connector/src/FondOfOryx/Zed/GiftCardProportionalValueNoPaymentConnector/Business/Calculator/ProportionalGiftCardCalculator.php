<?php

namespace FondOfOryx\Zed\GiftCardProportionalValueNoPaymentConnector\Business\Calculator;

use ArrayObject;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class ProportionalGiftCardCalculator implements ProportionalGiftCardCalculatorInterface
{
    /**
     * @var array
     */
    protected const EXPENSE_MAPPING = ['SHIPMENT_EXPENSE_TYPE' => 'freight'];

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculate(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject
    {
        $items = $this->prepareItems($orderEntity);
        $expenses = $this->prepareExpenses($orderEntity);

        return new ArrayObject(array_merge($items, $expenses));
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return array
     */
    protected function prepareItems(SpySalesOrder $orderEntity): array
    {
        $collection = [];

        foreach ($orderEntity->getItems() as $itemEntity) {
            $idSalesOrderItem = $itemEntity->getIdSalesOrderItem();
            $identifier = sprintf('item%s', $idSalesOrderItem);

            if (isset($collection[$identifier])) {
                continue;
            }

            $itemBalance = (new ProportionalGiftCardValueTransfer())
                ->setValue(
                    $itemEntity->getPriceToPayAggregation(),
                )
                ->setFkSalesOrderItem($idSalesOrderItem)
                ->setFkSalesOrder($orderEntity->getIdSalesOrder())
                ->setOrderReference($orderEntity->getOrderReference())
                ->setSku($itemEntity->getSku());

            $collection[$identifier] = $itemBalance;
        }

        return $collection;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     *
     * @return array
     */
    protected function prepareExpenses(SpySalesOrder $orderEntity): array
    {
        $collection = [];

        foreach ($orderEntity->getExpenses() as $expenseEntity) {
            $idSalesExpense = $expenseEntity->getIdSalesExpense();
            $expenseType = $expenseEntity->getType();
            $identifier = sprintf('expense%s', $idSalesExpense);

            if (
                !isset(static::EXPENSE_MAPPING[$expenseType]) || isset($collection[$identifier])
            ) {
                continue;
            }

            $itemBalance = (new ProportionalGiftCardValueTransfer())
                ->setValue(
                    $expenseEntity->getPriceToPayAggregation(),
                )
                ->setFkSalesExpense($idSalesExpense)
                ->setFkSalesOrder($orderEntity->getIdSalesOrder())
                ->setOrderReference($orderEntity->getOrderReference())
                ->setSku(static::EXPENSE_MAPPING[$expenseType]);

            $collection[$identifier] = $itemBalance;
        }

        return $collection;
    }
}
