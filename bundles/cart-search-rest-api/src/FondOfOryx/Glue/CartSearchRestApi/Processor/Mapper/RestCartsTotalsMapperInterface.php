<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartsTotalsTransfer;

interface RestCartsTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestCartsTotalsTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?RestCartsTotalsTransfer;
}
