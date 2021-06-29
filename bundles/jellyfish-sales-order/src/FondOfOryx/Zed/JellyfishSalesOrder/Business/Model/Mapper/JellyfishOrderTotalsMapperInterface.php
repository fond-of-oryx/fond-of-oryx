<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishOrderTotalsMapperInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTotalsTransfer
     */
    public function fromSalesOrder(SpySalesOrder $salesOrder): JellyfishOrderTotalsTransfer;
}
