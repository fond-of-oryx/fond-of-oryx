<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader;

use Generated\Shared\Transfer\QuoteTransfer;

interface CompanyUserReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getIdByQuote(QuoteTransfer $quoteTransfer): ?int;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return int|null
     */
    public function getDefaultIdByQuote(QuoteTransfer $quoteTransfer): ?int;
}
