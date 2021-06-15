<?php

namespace FondOfOryx\Zed\SplittableTotals\Dependency\Facade;

use FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableTotalsToSplittableQuoteFacadeBridge implements SplittableTotalsToSplittableQuoteFacadeInterface
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
