<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\SplittableTotalsResponseTransfer;

class SplittableTotalsReader implements SplittableTotalsReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface
     */
    protected $quoteSplitter;

    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Business\Reader\QuoteReaderInterface $quoteReader
     * @param \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface $quoteSplitter
     * @param \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface $calculationFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        QuoteSplitterInterface $quoteSplitter,
        SplittableTotalsToCalculationFacadeInterface $calculationFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->quoteSplitter = $quoteSplitter;
        $this->calculationFacade = $calculationFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsResponseTransfer
     */
    public function getBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): SplittableTotalsResponseTransfer {
        $splittableTotalsResponseTransfer = new SplittableTotalsResponseTransfer();
        $quoteTransfer = $this->quoteReader->getBySplittableTotalsRequest($splittableTotalsRequestTransfer);

        if ($quoteTransfer === null) {
            return $splittableTotalsResponseTransfer;
        }

        $quoteTransfers = $this->quoteSplitter->split($quoteTransfer);

        foreach ($quoteTransfers as $key => $quoteTransfer) {
            $quoteTransfer = $this->calculationFacade->recalculateQuote($quoteTransfer, false);
            $splittableTotalsResponseTransfer->addTotals($key, $quoteTransfer->getTotals());
        }

        return $splittableTotalsResponseTransfer;
    }
}
