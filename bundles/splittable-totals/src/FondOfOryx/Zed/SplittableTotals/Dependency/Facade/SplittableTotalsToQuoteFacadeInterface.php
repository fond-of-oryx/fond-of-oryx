<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;

interface SplittableTotalsToQuoteFacadeInterface
{
    /**
     * @param int $idQuote
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteById(int $idQuote): QuoteResponseTransfer;
}
