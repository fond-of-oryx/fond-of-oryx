<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Calculator;

use ArrayObject;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use function DeepCopy\deep_copy;

class ProportionalGiftCardCalculator implements ProportionalGiftCardCalculatorInterface
{
    /**
     * @var array
     */
    protected const EXPENSE_MAPPING = ['SHIPMENT_EXPENSE_TYPE' => 'freight'];

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface
     */
    protected $payoneService;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service\GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface $payoneService
     * @param \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Facade\GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface $salesFacade
     */
    public function __construct(
        GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface $payoneService,
        GiftCardProportionalValuePayoneConnectorToSalesFacadeInterface $salesFacade
    ) {
        $this->payoneService = $payoneService;
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $proportionalGiftCardValues
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    public function calculate(SpySalesOrder $orderEntity, ArrayObject $proportionalGiftCardValues): ArrayObject
    {
        //Sorry, need complete hydrated order mapped to transfer
        $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($orderEntity->getIdSalesOrder());

        $recalculatedOrderTransfer = $this->payoneService->distributeOrderPrice(deep_copy($orderTransfer));

        return $this->createGiftCardBalances($recalculatedOrderTransfer, $orderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $recalculatedOrderTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function createGiftCardBalances(OrderTransfer $recalculatedOrderTransfer, OrderTransfer $orderTransfer): ArrayObject
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
                $identifier = sprintf('item%s', $idSalesOrderItem);
                if (isset($collection[$identifier]) || $idSalesOrderItem !== $recalculatedIdSalesOrderItem) {
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

                $collection[$identifier] = $itemBalance;
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
                $identifier = sprintf('expense%s', $idSalesExpense);

                if (
                    !isset(static::EXPENSE_MAPPING[$expenseType]) || isset($collection[$identifier])
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

                $collection[$identifier] = $itemBalance;
            }
        }

        return $collection;
    }
}
