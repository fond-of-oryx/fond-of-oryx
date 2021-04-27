<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

interface SplittableTotalsRestApiToSplittableTotalsFacadeInterface
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
