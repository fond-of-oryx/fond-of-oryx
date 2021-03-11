<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business\Model;

use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteSplitterInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function split(QuoteTransfer $quoteTransfer): QuoteCollectionTransfer;
}
