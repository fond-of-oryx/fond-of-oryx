<?php

namespace FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote;

use ArrayObject;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestPaymentTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;

class PaymentQuoteMapper implements PaymentQuoteMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function mapPaymentsToQuote(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $restPaymentTransfers = $restSplittableCheckoutRequestAttributesTransfer->getPayments();

        if (!$restPaymentTransfers->count()) {
            return $quoteTransfer;
        }

        $quoteTransfer->setPayments($this->getPayments($restPaymentTransfers));

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \ArrayObject
     */
    protected function getPayments(RestPaymentTransfer $restPaymentTransfer ): ArrayObject
    {
        $payments = new ArrayObject();

        $payments->append($this->preparePaymentTransfer($restPaymentTransfers->offsetGet(0)));

        return $payments;
    }

    /**
     * @param \Generated\Shared\Transfer\RestPaymentTransfer $restPaymentTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentTransfer
     */
    protected function preparePaymentTransfer(RestPaymentTransfer $restPaymentTransfer): PaymentTransfer
    {
        $paymentTransfer = (new PaymentTransfer())->fromArray($restPaymentTransfer->toArray(), true);

        $paymentTransfer->setPaymentProvider($restPaymentTransfer->getPaymentProviderName())
            ->setPaymentMethod($restPaymentTransfer->getPaymentMethodName());

        return $paymentTransfer;
    }
}
