<?php

namespace FondOfOryx\Zed\SplittableQuote\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableQuoteToCalculationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param bool $executeQuotePlugins
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function recalculateQuote(QuoteTransfer $quoteTransfer, bool $executeQuotePlugins = true): QuoteTransfer;
}
