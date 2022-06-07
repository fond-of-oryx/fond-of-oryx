<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;

interface RestCartSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartSearchAttributesTransfer
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): RestCartSearchAttributesTransfer;
}
