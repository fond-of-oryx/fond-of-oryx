<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface NoPaymentCreditMemoFacadeInterface
{
    /**
     * Specification:
     * - Calculate refund amount for given order items and order entity
     *
     * @api
     *
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return void
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity);
}
