<?php

namespace FondOfOryx\Client\CartSearchRestApi\Zed;

use Generated\Shared\Transfer\QuoteListTransfer;

interface CartSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer;
}
