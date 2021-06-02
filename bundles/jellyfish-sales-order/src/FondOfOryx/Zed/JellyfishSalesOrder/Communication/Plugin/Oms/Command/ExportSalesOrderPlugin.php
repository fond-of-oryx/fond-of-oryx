<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\Business\JellyfishSalesOrderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig getConfig()
 */
class ExportSalesOrderPlugin extends AbstractPlugin implements CommandByOrderInterface
{
    /**
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $salesOrderItems, SpySalesOrder $salesOrderEntity, ReadOnlyArrayObject $data): array
    {
        $this->getFacade()->exportSalesOrder($salesOrderEntity, $salesOrderItems);

        return [];
    }
}
