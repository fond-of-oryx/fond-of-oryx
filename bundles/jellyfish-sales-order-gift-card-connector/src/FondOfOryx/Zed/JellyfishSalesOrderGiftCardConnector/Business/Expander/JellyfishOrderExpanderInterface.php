<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishOrderExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $spySalesOrder
    ): JellyfishOrderTransfer;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expandOrderItemsWithGiftCardRestrictionFlag(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): JellyfishOrderTransfer;
}
