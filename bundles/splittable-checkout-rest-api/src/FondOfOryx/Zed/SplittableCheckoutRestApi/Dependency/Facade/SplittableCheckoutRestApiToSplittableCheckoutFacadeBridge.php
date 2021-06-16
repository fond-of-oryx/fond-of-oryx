<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge implements SplittableCheckoutRestApiToSplittableCheckoutFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface
     */
    protected $splittableCheckoutFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckout\Business\SplittableCheckoutFacadeInterface $splittableCheckoutFacade
     */
    public function __construct(SplittableCheckoutFacadeInterface $splittableCheckoutFacade)
    {
        $this->splittableCheckoutFacade = $splittableCheckoutFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        return $this->splittableCheckoutFacade->placeOrder($quoteTransfer);
    }
}
