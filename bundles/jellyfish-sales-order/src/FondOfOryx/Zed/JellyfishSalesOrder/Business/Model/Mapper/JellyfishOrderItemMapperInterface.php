<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface JellyfishOrderItemMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderItemTransfer
     */
    public function fromSalesOrderItem(SpySalesOrderItem $salesOrderItem): JellyfishOrderItemTransfer;
}
