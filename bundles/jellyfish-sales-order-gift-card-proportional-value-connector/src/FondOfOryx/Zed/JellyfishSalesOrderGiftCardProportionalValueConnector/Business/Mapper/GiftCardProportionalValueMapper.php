<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class GiftCardProportionalValueMapper implements ProportionalValueMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function fromSalesOrderToJellyfishOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, SpySalesOrder $salesOrder): JellyfishOrderTransfer
    {
        $proportionalGiftCardValues = $salesOrder->getFooProportionalGiftCardValues();

        foreach ($proportionalGiftCardValues as $proportionalGiftCardValue) {
            $jellyfishOrderTransfer->addGiftCardBalance($this->fromFooProportionalGiftCardValueEntity($proportionalGiftCardValue));
        }

        return $jellyfishOrderTransfer;
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
}
