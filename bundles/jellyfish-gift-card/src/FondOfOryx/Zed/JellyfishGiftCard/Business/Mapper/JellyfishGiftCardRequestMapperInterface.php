<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface JellyfishGiftCardRequestMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer
     */
    public function fromSalesOrderItem(SpySalesOrderItem $spySalesOrderItem): JellyfishGiftCardRequestTransfer;
}
