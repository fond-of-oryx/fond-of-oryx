<?php

namespace FondOfOryx\Client\CartSearchRestApi;

use Generated\Shared\Transfer\QuoteListTransfer;

interface CartSearchRestApiClientInterface
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
