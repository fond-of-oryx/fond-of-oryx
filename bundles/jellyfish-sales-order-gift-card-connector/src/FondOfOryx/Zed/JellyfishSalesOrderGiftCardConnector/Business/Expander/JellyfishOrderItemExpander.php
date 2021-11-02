<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemExpander implements JellyfishOrderItemExpanderInterface
{
    /**
     * @var string
     */
    protected const PRODUCT_TYPE_GIFT_CARD = 'gift_card';

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function expand(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $spySalesOrderItem
    ): JellyfishOrderItemTransfer {
        if (
            $jellyfishOrderItemTransfer->getProductType() !== static::PRODUCT_TYPE_GIFT_CARD
            || $spySalesOrderItem->getSpySalesOrderItemGiftCards()->count() === 0
        ) {
            return $jellyfishOrderItemTransfer;
        }

        /** @var \Orm\Zed\Sales\Persistence\SpySalesOrderItemGiftCard $giftCard */
        $giftCard = $spySalesOrderItem
            ->getSpySalesOrderItemGiftCards()
            ->getFirst();

        return $jellyfishOrderItemTransfer->setGiftCardCode($giftCard->getCode());
    }
}
