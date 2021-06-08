<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutToQuoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function createQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}
