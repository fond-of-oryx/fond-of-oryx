<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \FondOfOryx\Zed\Prepayment\Business\PrepaymentFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\Prepayment\Communication\PrepaymentCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\Prepayment\PrepaymentConfig getConfig()
 */
class PayPlugin extends AbstractPlugin implements CommandByOrderInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        return [];
    }
}
