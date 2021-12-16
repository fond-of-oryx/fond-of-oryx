<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestTotalsTransfer;

interface RestTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\RestTotalsTransfer|null
     */
    public function fromQuote(QuoteTransfer $quoteTransfer): ?RestTotalsTransfer;
}
