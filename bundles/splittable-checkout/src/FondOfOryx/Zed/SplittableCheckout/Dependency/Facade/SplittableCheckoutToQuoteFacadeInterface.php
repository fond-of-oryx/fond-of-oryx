<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutToQuoteFacadeInterface
{
    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\QuoteTransfer $quoteTransfer
     *
     * @return \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\QuoteResponseTransfer
     */
    public function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}
