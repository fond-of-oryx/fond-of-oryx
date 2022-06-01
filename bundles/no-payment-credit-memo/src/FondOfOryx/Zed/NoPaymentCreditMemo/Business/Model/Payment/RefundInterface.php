<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Business\Model\Payment;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface RefundInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return bool
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity): bool;
}
