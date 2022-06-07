<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsAttributesTransfer;

interface RestCartsAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsAttributesTransfer
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): RestCartsAttributesTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCartsAttributesTransfer>
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): ArrayObject;
}
