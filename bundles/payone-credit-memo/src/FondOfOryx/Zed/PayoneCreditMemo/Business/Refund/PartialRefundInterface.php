<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Business\Refund;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

interface PartialRefundInterface
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
    public function executePartialRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array;
}
