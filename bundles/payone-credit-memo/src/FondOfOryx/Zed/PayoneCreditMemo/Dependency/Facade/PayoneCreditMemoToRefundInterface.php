<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface PayoneCreditMemoToRefundInterface
{
    /**
     * Specification:
     * - Calculates refund amount for given OrderTransfer and OrderItems which should be refunded.
     * - Adds refundable amount to RefundTransfer object and returns it.
     * - Uses calculator plugin stack for calculation.
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return \Generated\Shared\Transfer\RefundTransfer
     */
    public function calculateRefund(
        array $salesOrderItems,
        SpySalesOrder $salesOrderEntity
    ): RefundTransfer;

    /**
     * Specification:
     * - Persists calculated Refund amount.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return bool
     */
    public function saveRefund(RefundTransfer $refundTransfer);
}
