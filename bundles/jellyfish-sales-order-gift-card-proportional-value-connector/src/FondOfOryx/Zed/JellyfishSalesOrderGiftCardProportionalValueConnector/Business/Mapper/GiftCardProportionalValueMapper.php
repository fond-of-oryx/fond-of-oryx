<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\JellyfishProportionalCouponValueTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardProportionalValueMapper implements ProportionalValueMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig $config
     */
    public function __construct(JellyfishSalesOrderGiftCardProportionalValueConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function fromSalesOrderToJellyfishOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, SpySalesOrder $salesOrder): JellyfishOrderTransfer
    {
        $proportionalGiftCardValues = $salesOrder->getFooProportionalGiftCardValues();

        $balances = [];
        foreach ($proportionalGiftCardValues as $proportionalGiftCardValue) {
            $balances[] = $this->fromFooProportionalGiftCardValueEntity($proportionalGiftCardValue);
        }

        $usedBalances = [];

        foreach ($balances as $balance) {
            $usedBalances = $this->appendProportionalValueToItems($jellyfishOrderTransfer, $balance, $usedBalances);
            $usedBalances = $this->appendProportionalValueToExpenses($jellyfishOrderTransfer, $balance, $usedBalances);
        }

        return $jellyfishOrderTransfer->setGiftCardBalances(new ArrayObject($balances));
    }

    /**
     * @param \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue $proportionalGiftCardValueEntity
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    protected function fromFooProportionalGiftCardValueEntity(FooProportionalGiftCardValue $proportionalGiftCardValueEntity): ProportionalGiftCardValueTransfer
    {
        return (new ProportionalGiftCardValueTransfer())
            ->setFkSalesOrderItem($proportionalGiftCardValueEntity->getFkSalesOrderItem())
            ->setFkSalesOrder($proportionalGiftCardValueEntity->getFkSalesOrder())
            ->setFkSalesExpense($proportionalGiftCardValueEntity->getFkSalesExpense())
            ->setOrderReference($proportionalGiftCardValueEntity->getOrderReference())
            ->setSku($proportionalGiftCardValueEntity->getSku())
            ->setValue($proportionalGiftCardValueEntity->getValue());
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $balance
     * @param array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer> $usedBalances
     *
     * @return array<\Generated\Shared\Transfer\ProportionalGiftCardValueTransfer>
     */
    protected function appendProportionalValueToItems(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        ProportionalGiftCardValueTransfer $balance,
        array $usedBalances
    ): array {
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
    protected function appendProportionalValueToExpenses(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        ProportionalGiftCardValueTransfer $balance,
        array $usedBalances
    ): array {
        $expenseMapping = $this->config->getExpenseMapping();

        foreach ($jellyfishOrderTransfer->getExpenses() as $expense) {
            $idSalesExpense = $balance->getFkSalesExpense();

            if ($idSalesExpense === null) {
                continue;
            }

            $expenseType = $expense->getType();
            $identifier = $idSalesExpense . $expenseType;

            if (isset($usedBalances[$identifier]) || !isset($expenseMapping[$expenseType]) || $expenseMapping[$expenseType] !== $balance->getSku()) {
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
