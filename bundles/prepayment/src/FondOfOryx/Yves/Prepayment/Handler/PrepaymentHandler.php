<?php

namespace FondOfOryx\Yves\Prepayment\Handler;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentHandler
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addPaymentToQuote(QuoteTransfer $quoteTransfer)
    {
        $this->setPaymentProviderAndMethod($quoteTransfer);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    protected function setPaymentProviderAndMethod(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->getPayment()
            ->setPaymentProvider(PrepaymentConstants::PROVIDER_NAME)
            ->setPaymentMethod(PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT);
    }
}
