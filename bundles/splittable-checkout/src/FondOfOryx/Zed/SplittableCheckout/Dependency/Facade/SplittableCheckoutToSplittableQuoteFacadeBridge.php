<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutToSplittableQuoteFacadeBridge implements SplittableCheckoutToSplittableQuoteFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface
     */
    protected $splittableQuoteFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface $splittableQuoteFacade
     */
    public function __construct(SplittableQuoteFacadeInterface $splittableQuoteFacade)
    {
        $this->splittableQuoteFacade = $splittableQuoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function splitQuote(QuoteTransfer $quoteTransfer): array
    {
        return $this->splittableQuoteFacade->splitQuote($quoteTransfer);
    }
}
