<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Business\PayoneCreditMemoBusinessFactory getFactory()
 */
class PayoneCreditMemoFacade extends AbstractFacade implements PayoneCreditMemoFacadeInterface
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
    public function executePartialRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        return $this->getFactory()->createPartialRefund()->executePartialRefund($orderItems, $orderEntity, $data);
    }
}
