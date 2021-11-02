<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByOrderInterface;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Business\PrepaymentCreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Communication\PrepaymentCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoConfig getConfig()
 */
class RefundPlugin extends AbstractPlugin implements CommandByOrderInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $this->getFacade()->refund($salesOrderItems, $orderEntity);

        return [];
    }
}
