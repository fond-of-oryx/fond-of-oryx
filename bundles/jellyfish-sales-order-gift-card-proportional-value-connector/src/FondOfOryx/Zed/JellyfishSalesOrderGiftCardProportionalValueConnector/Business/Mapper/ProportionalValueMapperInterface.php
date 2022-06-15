<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface ProportionalValueMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function fromSalesOrderToJellyfishOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, SpySalesOrder $salesOrder): JellyfishOrderTransfer;
}
