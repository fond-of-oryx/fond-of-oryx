<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\NoPaymentCreditMemo\Business\NoPaymentCreditMemoBusinessFactory getFactory()
 */
class NoPaymentCreditMemoFacade extends AbstractFacade implements NoPaymentCreditMemoFacadeInterface
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
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity)
    {
        $this->getFactory()->createRefund()->refund($salesOrderItems, $salesOrderEntity);
    }
}
