<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

interface SplittableTotalsFacadeInterface
{
    /**
     * Specifications:
     * - Splits quote by configurable item attribute
     * - Recalculates splitted quotes
     * - Retrieves totals per splitted quote
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getSplittableTotalsByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer;
}
