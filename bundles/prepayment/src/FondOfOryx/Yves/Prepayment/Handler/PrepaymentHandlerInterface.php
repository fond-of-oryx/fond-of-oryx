<?php

namespace FondOfOryx\Yves\Prepayment\Handler;

use Generated\Shared\Transfer\QuoteTransfer;

interface PrepaymentHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addPaymentToQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
