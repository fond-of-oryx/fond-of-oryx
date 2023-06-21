<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer;

use Generated\Shared\Transfer\QuoteTransfer;

interface CompanyUserWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function setDefaultByQuote(QuoteTransfer $quoteTransfer): void;
}
