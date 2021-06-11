<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableTotalsToSplittableQuoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function splitQuote(QuoteTransfer $quoteTransfer): array;
}
