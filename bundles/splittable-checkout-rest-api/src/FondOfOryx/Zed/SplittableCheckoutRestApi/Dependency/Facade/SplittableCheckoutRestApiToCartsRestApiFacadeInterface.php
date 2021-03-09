<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutRestApiToCartsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}
