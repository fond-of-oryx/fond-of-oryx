<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

interface SplittableTotalsReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer;
}
