<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

interface SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer;
}
