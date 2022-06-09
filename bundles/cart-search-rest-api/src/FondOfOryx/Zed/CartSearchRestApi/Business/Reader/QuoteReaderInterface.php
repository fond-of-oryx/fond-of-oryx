<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business\Reader;

use ArrayObject;
use Generated\Shared\Transfer\QuoteListTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findByQuoteList(QuoteListTransfer $quoteListTransfer): QuoteListTransfer;

    /**
     * @param array<int> $quoteIds
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function findByQuoteIds(array $quoteIds): ArrayObject;
}
