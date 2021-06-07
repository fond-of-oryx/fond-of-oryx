<?php

namespace FondOfOryx\Zed\SplittableQuote\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableQuoteFacadeInterface
{
    /**
     * Specifications:
     * - Splits quote by configurable item attribute
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function splitQuote(QuoteTransfer $quoteTransfer): array;
}
