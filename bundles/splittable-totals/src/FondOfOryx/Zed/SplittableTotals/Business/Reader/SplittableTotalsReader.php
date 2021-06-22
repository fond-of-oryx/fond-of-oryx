<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface
     */
    protected $splittableQuoteFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToSplittableQuoteFacadeInterface $splittableQuoteFacade
     */
    public function __construct(
        SplittableTotalsToSplittableQuoteFacadeInterface $splittableQuoteFacade
    ) {
        $this->splittableQuoteFacade = $splittableQuoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer {
        $splittedQuoteTransfers = $this->splittableQuoteFacade->splitQuote($quoteTransfer);
        $splittableTotalsTransfer = (new SplittableTotalsTransfer());

        foreach ($splittedQuoteTransfers as $key => $splittedQuoteTransfer) {
            $splittableTotalsTransfer->addTotals($key, $splittedQuoteTransfer->getTotals());
        }

        return $splittableTotalsTransfer;
    }
}
