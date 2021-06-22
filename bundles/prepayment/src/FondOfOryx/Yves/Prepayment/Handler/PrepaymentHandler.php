<?php

namespace FondOfOryx\Yves\Prepayment\Handler;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentHandler implements PrepaymentHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addPaymentToQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $this->setPaymentProviderAndMethod($quoteTransfer);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    protected function setPaymentProviderAndMethod(QuoteTransfer $quoteTransfer): void
    {
        $paymentTranser = $quoteTransfer->getPayment();
        $paymentTranser
            ->setPaymentProvider(PrepaymentConstants::PROVIDER_NAME)
            ->setPaymentMethod(PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT);

        $quoteTransfer->setPayment($paymentTranser);
    }
}
