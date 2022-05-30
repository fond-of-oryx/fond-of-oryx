<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence;

use Generated\Shared\Transfer\QuoteListTransfer;

interface CartSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer;
}
