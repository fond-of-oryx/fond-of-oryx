<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business\Reader;

use Generated\Shared\Transfer\QuoteListTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findByQuoteList(QuoteListTransfer $quoteListTransfer): QuoteListTransfer;
}
