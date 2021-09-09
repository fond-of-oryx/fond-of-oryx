<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderTotalsTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpander implements JellyfishOrderExpanderInterface
{
    protected const SALES_PAYMENT_METHOD_GIFT_CARD = 'GiftCard';

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapper;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper
     */
    public function __construct(
        JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper
    ) {
        $this->jellyfishOrderGiftCardMapper = $jellyfishOrderGiftCardMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $giftCardPayments = $this->getGiftCardPayments($salesOrder);

        if ($giftCardPayments->count() === 0) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer
            ->setGiftCards($this->mapSalesPaymentsToGiftCards($giftCardPayments))
            ->setTotals($this->recalculateTotals($jellyfishOrderTransfer, $giftCardPayments));
    }

    /**
     * @param \ArrayObject $payments
     *
     * @return \ArrayObject
     */
    protected function mapSalesPaymentsToGiftCards(ArrayObject $payments): ArrayObject
    {
        $jellyfishOrderGiftCards = new ArrayObject();

        foreach ($payments as $payment) {
            $jellyfishOrderGiftCards->append(
                $this->jellyfishOrderGiftCardMapper->fromSalesPayment($payment)
            );
        }

        return $jellyfishOrderGiftCards;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \ArrayObject $payments
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTotalsTransfer
     */
    protected function recalculateTotals(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        ArrayObject $payments
    ): JellyfishOrderTotalsTransfer {
        $jellyfishOrderTotalTransfer = $jellyfishOrderTransfer->getTotals();
        $grandTotal = $jellyfishOrderTotalTransfer->getGrandTotal();
        $discountTotal = $jellyfishOrderTotalTransfer->getDiscountTotal();

        /** @var \Orm\Zed\Payment\Persistence\SpySalesPayment $payment */
        foreach ($payments as $payment) {
            $grandTotal = $grandTotal - $payment->getAmount();
            $discountTotal = $discountTotal + $payment->getAmount();
        }

        return $jellyfishOrderTotalTransfer
            ->setDiscountTotal($discountTotal)
            ->setGrandTotal($grandTotal);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function getGiftCardPayments(SpySalesOrder $salesOrder): ArrayObject
    {
        $giftCardPayments = new ArrayObject();

        foreach ($salesOrder->getOrdersJoinSalesPaymentMethodType() as $salesPayment) {
            if (
                $salesPayment->getSalesPaymentMethodType()->getPaymentMethod()
                !== static::SALES_PAYMENT_METHOD_GIFT_CARD
            ) {
                continue;
            }

            $giftCardPayments->append($salesPayment);
        }

        return $giftCardPayments;
    }
}
