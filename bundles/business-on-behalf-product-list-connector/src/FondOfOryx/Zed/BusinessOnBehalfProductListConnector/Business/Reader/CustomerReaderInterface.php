<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface CustomerReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getByQuote(QuoteTransfer $quoteTransfer): ?CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getIdByQuote(QuoteTransfer $quoteTransfer): ?int;
}
