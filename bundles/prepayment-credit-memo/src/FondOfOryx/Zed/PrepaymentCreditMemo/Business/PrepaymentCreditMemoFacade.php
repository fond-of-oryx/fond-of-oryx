<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Business;

use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Business\PrepaymentCreditMemoBusinessFactory getFactory()
 */
class PrepaymentCreditMemoFacade extends AbstractFacade implements PrepaymentCreditMemoFacadeInterface
{
    /**
     * Specification:
     * - Calculate refund amount for given order items and order entity
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return void
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity)
    {
        $this->getFactory()->createRefund()->refund($salesOrderItems, $salesOrderEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    public function refundCreditMemo(CreditMemoTransfer $creditMemoTransfer): bool
    {
        return $this->getFactory()->createRefund()->refundCreditMemo($creditMemoTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoResponseTransfer
     */
    public function updateCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoResponseTransfer
    {
        return $this->getFactory()->getCreditMemoFacade()->updateCreditMemo($creditMemoTransfer);
    }
}
