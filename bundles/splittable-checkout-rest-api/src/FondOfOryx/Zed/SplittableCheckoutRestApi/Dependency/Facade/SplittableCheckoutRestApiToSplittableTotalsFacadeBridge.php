<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableCheckoutRestApiToSplittableTotalsFacadeBridge implements
    SplittableCheckoutRestApiToSplittableTotalsFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface
     */
    protected $splittableTotalsFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsFacadeInterface $splittableTotalsFacade
     */
    public function __construct(SplittableTotalsFacadeInterface $splittableTotalsFacade)
    {
        $this->splittableTotalsFacade = $splittableTotalsFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getSplittableTotalsByQuote(QuoteTransfer $quoteTransfer): SplittableTotalsTransfer
    {
        return $this->splittableTotalsFacade->getSplittableTotalsByQuote($quoteTransfer);
    }
}
