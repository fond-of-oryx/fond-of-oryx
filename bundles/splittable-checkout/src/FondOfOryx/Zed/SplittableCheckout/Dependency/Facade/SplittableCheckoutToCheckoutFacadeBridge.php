<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Checkout\Business\CheckoutFacadeInterface;

class SplittableCheckoutToCheckoutFacadeBridge implements SplittableCheckoutToCheckoutFacadeInterface
{
    /**
     * @var \Spryker\Zed\Checkout\Business\CheckoutFacadeInterface
     */
    protected $checkoutFacade;

    /**
     * @param \Spryker\Zed\Checkout\Business\CheckoutFacadeInterface $checkoutFacade
     */
    public function __construct(CheckoutFacadeInterface $checkoutFacade)
    {
        $this->checkoutFacade = $checkoutFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\CheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): CheckoutResponseTransfer
    {
        return $this->checkoutFacade->placeOrder($quoteTransfer);
    }
}
