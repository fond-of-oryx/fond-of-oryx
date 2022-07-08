<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use SprykerEco\Zed\Payone\Communication\Plugin\Oms\Command\PartialRefundCommandPlugin as SprykerEcoPartialRefundCommandPlugin;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Business\PayoneCreditMemoFacadeInterface getFacade()
 */
class PartialDebitCommandPlugin extends SprykerEcoPartialRefundCommandPlugin
{
    /**
     * @api
     *
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        return $this->getFacade()->executePartialDebit($orderItems, $orderEntity, $data);
    }
}
