<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Communication\JellyfishCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig getConfig()
 */
class JellyfishExportCommandPlugin extends AbstractPlugin implements CommandByOrderInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $this->getFacade()->exportCreditMemo($orderEntity->getIdSalesOrder(), $this->getItemIds($salesOrderItems));

        return [];
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     *
     * @return int[]
     */
    protected function getItemIds(array $salesOrderItems): array
    {
        $ids = [];
        foreach ($salesOrderItems as $salesOrderItem) {
            $ids[] = $salesOrderItem->getIdSalesOrderItem();
        }

        return $ids;
    }
}
