<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

interface SplittableCheckoutRestApiToSplittableTotalsFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getSplittableTotalsByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer;
}
