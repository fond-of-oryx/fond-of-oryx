<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface JellyfishOrderItemExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function expand(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        SpySalesOrderItem $spySalesOrderItem
    ): JellyfishOrderItemTransfer;
}
