<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business;

use Generated\Shared\Transfer\QuoteListTransfer;

interface CartSearchRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds quotes by criteria from QuoteListTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer;
}
