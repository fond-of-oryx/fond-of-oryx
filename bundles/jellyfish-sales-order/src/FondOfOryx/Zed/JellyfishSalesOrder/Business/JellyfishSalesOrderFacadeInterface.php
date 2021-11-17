<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface JellyfishSalesOrderFacadeInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     *
     * @return void
     */
    public function exportSalesOrder(SpySalesOrder $salesOrderEntity, array $salesOrderItems): void;

    /**
     * @return void
     */
    public function triggerSalesOrderExport(): void;
}
