<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface SalesOrderExporterInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return void
     */
    public function export(SpySalesOrder $salesOrderEntity, array $salesOrderItems): void;
}
