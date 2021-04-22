<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableTotalsToCalculationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param bool $executeQuotePlugins
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function recalculateQuote(QuoteTransfer $quoteTransfer, bool $executeQuotePlugins = true): QuoteTransfer;
}
