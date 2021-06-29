<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishOrderMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function fromSalesOrder(SpySalesOrder $salesOrder): JellyfishOrderTransfer;
}
