<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander;

use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishOrderItemExpander implements JellyfishOrderItemExpanderInterface
{
    protected const PRODUCT_TYPE_PRODUCT = 'product';
    protected const PRODUCT_TYPE_GIFT_CARD = 'gift_card';

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
     */
    protected $giftCardFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface $giftCardFacade
     */
    public function __construct(
        JellyfishSalesOrderProductTypeToGiftCardFacadeInterface $giftCardFacade
    ) {
        $this->giftCardFacade = $giftCardFacade;
    }

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
        return $jellyfishOrderItemTransfer->setProductType($this->getProductType($spySalesOrderItem));
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return string
     */
    protected function getProductType(SpySalesOrderItem $spySalesOrderItem): string
    {
        if ($this->giftCardFacade->isGiftCardOrderItem($spySalesOrderItem->getIdSalesOrderItem())) {
            return self::PRODUCT_TYPE_GIFT_CARD;
        }

        return self::PRODUCT_TYPE_PRODUCT;
    }
}
