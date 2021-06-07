<?php

namespace FondOfOryx\Zed\SplittableQuote\Business\Splitter;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteSplitterInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function split(QuoteTransfer $quoteTransfer): array;
}
