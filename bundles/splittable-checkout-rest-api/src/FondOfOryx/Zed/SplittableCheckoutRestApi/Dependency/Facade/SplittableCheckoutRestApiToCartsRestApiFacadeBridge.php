<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutRestApiToCartsRestApiFacadeBridge implements SplittableCheckoutRestApiToCartsRestApiFacadeInterface
{
    /**
     * @var \Spryker\Zed\CartsRestApi\Business\CartsRestApiFacadeInterface
     */
    protected $cartsRestApiFacade;

    /**
     * @param \Spryker\Zed\CartsRestApi\Business\CartsRestApiFacadeInterface $cartsRestApiFacade
     */
    public function __construct($cartsRestApiFacade)
    {
        $this->cartsRestApiFacade = $cartsRestApiFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function findQuoteByUuid(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->cartsRestApiFacade->findQuoteByUuid($quoteTransfer);
    }
}
