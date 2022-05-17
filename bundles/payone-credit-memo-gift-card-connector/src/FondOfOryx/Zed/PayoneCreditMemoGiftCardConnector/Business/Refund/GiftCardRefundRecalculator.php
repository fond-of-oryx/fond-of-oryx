<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\Refund;

use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundTransfer;
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
        $totalGiftCardRefundAmount = $this->updateItemAmounts($creditMemoEntity, $order, 0);
        $totalGiftCardRefundAmount = $this->updateExpenseAmountsOrder($creditMemoEntity, $order, $totalGiftCardRefundAmount);

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

        $totalGiftCardRefundAmount = $this->updateExpenseAmountsRefund($creditMemoEntity, $refund, $totalGiftCardRefundAmount);

        $refund->setAmount($refund->getAmount() - $totalGiftCardRefundAmount);

        return $partialOperationRequestTransfer->setRefund($refund);
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     * @param \Generated\Shared\Transfer\OrderTransfer $order
     * @param int|null $totalGiftCardRefundAmount
     *
     * @return int|null
     */
    protected function updateItemAmounts(FooCreditMemo $creditMemoEntity, OrderTransfer $order, ?int $totalGiftCardRefundAmount): ?int
    {
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

        return $totalGiftCardRefundAmount;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     * @param \Generated\Shared\Transfer\OrderTransfer $order
     * @param int $totalGiftCardRefundAmount
     *
     * @return int|null
     */
    protected function updateExpenseAmountsOrder(FooCreditMemo $creditMemoEntity, OrderTransfer $order, int $totalGiftCardRefundAmount): ?int
    {
        if ($creditMemoEntity->getChargeAmount() === null) {
            return $totalGiftCardRefundAmount;
        }

        $orderEntity = $creditMemoEntity->getSpySalesOrder();
        $proportionalGiftCardValues = $orderEntity->getFooProportionalGiftCardValues();

        foreach ($order->getExpenses() as $expenseTransfer) {
            foreach ($proportionalGiftCardValues as $proportionalGiftCardValue) {
                if (
                    $proportionalGiftCardValue->isRefund() === true
                    || $expenseTransfer->getIdSalesExpense() !== $proportionalGiftCardValue->getFkSalesExpense()
                ) {
                    continue;
                }
                $giftCardRefundAmount = $proportionalGiftCardValue->getValue();
                $price = $expenseTransfer->getUnitPriceToPayAggregation() - $giftCardRefundAmount;
                $expenseTransfer->setUnitPriceToPayAggregation($price);
                $expenseTransfer->setSumPriceToPayAggregation($price);
                $expenseTransfer->setUnitGrossPrice($price);
                $expenseTransfer->setRefundableAmount($price);
                $totalGiftCardRefundAmount += $giftCardRefundAmount;
            }
        }

        return $totalGiftCardRefundAmount;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     * @param \Generated\Shared\Transfer\RefundTransfer $refund
     * @param int $totalGiftCardRefundAmount
     *
     * @return int|null
     */
    protected function updateExpenseAmountsRefund(FooCreditMemo $creditMemoEntity, RefundTransfer $refund, int $totalGiftCardRefundAmount): ?int
    {
        if ($creditMemoEntity->getChargeAmount() === null) {
            return $totalGiftCardRefundAmount;
        }

        $refundEntity = $creditMemoEntity->getSpySalesOrder();
        $proportionalGiftCardValues = $refundEntity->getFooProportionalGiftCardValues();

        foreach ($refund->getExpenses() as $expenseTransfer) {
            foreach ($proportionalGiftCardValues as $proportionalGiftCardValue) {
                if (
                    $proportionalGiftCardValue->isRefund() === true
                    || $expenseTransfer->getIdSalesExpense() !== $proportionalGiftCardValue->getFkSalesExpense()
                ) {
                    continue;
                }
                $giftCardRefundAmount = $proportionalGiftCardValue->getValue();
                $price = $expenseTransfer->getUnitPriceToPayAggregation() - $giftCardRefundAmount;
                $expenseTransfer->setUnitPriceToPayAggregation($price);
                $expenseTransfer->setSumPriceToPayAggregation($price);
                $expenseTransfer->setUnitGrossPrice($price);
                $expenseTransfer->setRefundableAmount($price);
                $totalGiftCardRefundAmount += $giftCardRefundAmount;
            }
        }

        return $totalGiftCardRefundAmount;
    }
}
