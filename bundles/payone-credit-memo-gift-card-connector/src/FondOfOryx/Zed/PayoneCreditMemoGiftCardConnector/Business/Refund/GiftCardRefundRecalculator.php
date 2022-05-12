<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

class GiftCardRefundRecalculator implements GiftCardRefundRecalculatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function recalculate(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        $partialOperationRequestTransfer = $this->updateOrderAmounts($partialOperationRequestTransfer, $creditMemoEntity);

        return $this->updateRefundTotals($partialOperationRequestTransfer, $creditMemoEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function updateOrderAmounts(PayonePartialOperationRequestTransfer $partialOperationRequestTransfer, FooCreditMemo $creditMemoEntity)
    {
        $order = $partialOperationRequestTransfer->getOrder();
        $totalGiftCardRefundAmount = 0;
        foreach ($creditMemoEntity->getFooCreditMemoItems() as $fooCreditMemoItem) {
            foreach ($order->getItems() as $orderItem) {
                if ($orderItem->getIdSalesOrderItem() === $fooCreditMemoItem->getFkSalesOrderItem()) {
                    $giftCardRefundAmount = $fooCreditMemoItem->getCouponAmount();
                    $price = $orderItem->getUnitPriceToPayAggregation() - $giftCardRefundAmount;
                    $orderItem->setUnitPriceToPayAggregation($price);
                    $orderItem->setSumPriceToPayAggregation($price);
                    $orderItem->setUnitGrossPrice($price);
                    $orderItem->setRefundableAmount($price);
                    $totalGiftCardRefundAmount += $giftCardRefundAmount;
                }
            }
        }

        $totals = $order->getTotals();
        $totals->setGrandTotal($totals->getGrandTotal() - $totalGiftCardRefundAmount);
        $order->setTotals($totals);

        return $partialOperationRequestTransfer->setOrder($order);
    }

    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function updateRefundTotals(PayonePartialOperationRequestTransfer $partialOperationRequestTransfer, FooCreditMemo $creditMemoEntity)
    {
        $refund = $partialOperationRequestTransfer->getRefund();
        $totalGiftCardRefundAmount = 0;
        foreach ($creditMemoEntity->getFooCreditMemoItems() as $fooCreditMemoItem) {
            foreach ($refund->getItems() as $refundItem) {
                if ($refundItem->getIdSalesOrderItem() === $fooCreditMemoItem->getFkSalesOrderItem()) {
                    $giftCardRefundAmount = $fooCreditMemoItem->getCouponAmount();
                    $price = $refundItem->getUnitPriceToPayAggregation() - $giftCardRefundAmount;
                    $refundItem->setUnitPriceToPayAggregation($price);
                    $refundItem->setSumPriceToPayAggregation($price);
                    $refundItem->setRefundableAmount($price);
                    $totalGiftCardRefundAmount += $giftCardRefundAmount;
                }
            }
        }

        $refund->setAmount($refund->getAmount() - $totalGiftCardRefundAmount);

        return $partialOperationRequestTransfer->setRefund($refund);
    }
}
