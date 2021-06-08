<?php

namespace FondOfOryx\Zed\SplittableCheckout\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory getFactory()
 */
class SplittableCheckoutFacade extends AbstractFacade implements SplittableCheckoutFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        return $this->getFactory()->createSplittableCheckoutWorkflow()->placeOrder($quoteTransfer);
    }
}
