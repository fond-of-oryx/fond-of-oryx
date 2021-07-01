<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderBusinessFactory getFactory()
 */
class JellyfishSalesOrderFacade extends AbstractFacade implements JellyfishSalesOrderFacadeInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return void
     */
    public function exportSalesOrder(SpySalesOrder $salesOrderEntity, array $salesOrderItems): void
    {
        $this->getFactory()->createSalesOrderExporter()->export($salesOrderEntity, $salesOrderItems);
    }
}
