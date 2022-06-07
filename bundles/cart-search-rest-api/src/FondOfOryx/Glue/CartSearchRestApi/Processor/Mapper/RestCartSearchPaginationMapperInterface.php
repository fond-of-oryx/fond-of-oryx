<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchPaginationTransfer;

interface RestCartSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartSearchPaginationTransfer
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): RestCartSearchPaginationTransfer;
}
