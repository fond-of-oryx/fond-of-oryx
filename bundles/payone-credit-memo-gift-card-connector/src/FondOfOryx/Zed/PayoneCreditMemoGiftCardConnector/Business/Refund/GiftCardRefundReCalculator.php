<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund;

use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

class GiftCardRefundReCalculator implements GiftCardRefundReCalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function reCalculate(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        $orderTransfer = $partialOperationRequestTransfer->getOrder();
        if ($orderTransfer !== null) {
            $orderTransfer = $this->updateItemRefundAmount($orderTransfer, $creditMemoEntity);
            $partialOperationRequestTransfer->setOrder($orderTransfer);
            $partialOperationRequestTransfer = $this->updateTotals($partialOperationRequestTransfer, $this->recalculateTotalRefund($creditMemoEntity));
        }

        return $partialOperationRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function updateItemRefundAmount(OrderTransfer $orderTransfer, FooCreditMemo $creditMemoEntity): OrderTransfer
    {
        foreach ($orderTransfer->getItems() as &$orderItemTransfer) {
            foreach ($creditMemoEntity->getFooCreditMemoItems() as $creditMemoItem) {
                if ($orderItemTransfer->getSku() === $creditMemoItem->getSku()) {
                    $orderItemTransfer->setRefundableAmount($orderItemTransfer->getRefundableAmount() - $creditMemoItem->getCouponAmount());
                }
            }
        }
        unset($orderItemTransfer);

        return $orderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param int $giftCardRefund
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function updateTotals(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        int $giftCardRefund
    ): PayonePartialOperationRequestTransfer {
        $orderTransfer = $partialOperationRequestTransfer->getOrder();
        if ($orderTransfer === null) {
            return $partialOperationRequestTransfer;
        }
        $totals = $orderTransfer->getTotals();
        if ($totals !== null) {
            $totals->setRefundTotal($totals->getRefundTotal() - $giftCardRefund);
            $orderTransfer->setTotals($totals);
            $refundTransfer = $partialOperationRequestTransfer->getRefund();
            $refundTransfer->setAmount($totals->getRefundTotal());
            $partialOperationRequestTransfer->setRefund($refundTransfer);
        }

        return $partialOperationRequestTransfer;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return int
     */
    protected function recalculateTotalRefund(FooCreditMemo $creditMemoEntity): int
    {
        $giftCardRefund = 0;
        foreach ($creditMemoEntity->getFooCreditMemoGiftCards() as $giftCard) {
            $giftCardRefund += $giftCard->getRefund();
        }

        return $giftCardRefund;
    }
}
