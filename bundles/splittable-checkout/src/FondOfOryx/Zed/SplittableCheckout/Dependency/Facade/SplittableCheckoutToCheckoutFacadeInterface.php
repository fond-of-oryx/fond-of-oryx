<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutToCheckoutFacadeInterface
{
    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): CheckoutResponseTransfer;
}
