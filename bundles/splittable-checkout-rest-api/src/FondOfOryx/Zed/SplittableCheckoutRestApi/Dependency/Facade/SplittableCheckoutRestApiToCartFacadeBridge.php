<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutRestApiToCartFacadeBridge implements SplittableCheckoutRestApiToCartFacadeInterface
{
    /**
     * @var \Spryker\Zed\Cart\Business\CartFacadeInterface
     */
    protected $cartFacade;

    /**
     * @param \Spryker\Zed\Cart\Business\CartFacadeInterface $cartFacade
     */
    public function __construct($cartFacade)
    {
        $this->cartFacade = $cartFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer)
    {
        return $this->cartFacade->validateQuote($quoteTransfer);
    }
}
