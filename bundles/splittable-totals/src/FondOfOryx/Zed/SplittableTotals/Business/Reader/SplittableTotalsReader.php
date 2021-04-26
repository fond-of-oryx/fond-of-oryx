<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface
     */
    protected $quoteSplitter;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface $quoteSplitter
     * @param \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface $calculationFacade
     */
    public function __construct(
        QuoteSplitterInterface $quoteSplitter,
        SplittableTotalsToCalculationFacadeInterface $calculationFacade
    ) {
        $this->quoteSplitter = $quoteSplitter;
        $this->calculationFacade = $calculationFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer {
        $splittedQuoteTransfers = $this->quoteSplitter->split($quoteTransfer);
        $splittableTotalsTransfer = (new SplittableTotalsTransfer());

        foreach ($splittedQuoteTransfers as $key => $splittedQuoteTransfer) {
            $splittedQuoteTransfer = $this->calculationFacade->recalculateQuote($splittedQuoteTransfer, false);
            $splittableTotalsTransfer->addTotals($key, $splittedQuoteTransfer->getTotals());
        }

        return $splittableTotalsTransfer;
    }
}
