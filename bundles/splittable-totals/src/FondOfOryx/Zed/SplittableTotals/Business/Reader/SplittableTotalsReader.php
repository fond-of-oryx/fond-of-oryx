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
     * @var \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[]
     */
    protected $splittedQuoteExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Business\Splitter\QuoteSplitterInterface $quoteSplitter
     * @param \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeInterface $calculationFacade
     * @param \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[] $splittedQuoteExpanderPlugins
     */
    public function __construct(
        QuoteSplitterInterface $quoteSplitter,
        SplittableTotalsToCalculationFacadeInterface $calculationFacade,
        array $splittedQuoteExpanderPlugins = []
    ) {
        $this->quoteSplitter = $quoteSplitter;
        $this->calculationFacade = $calculationFacade;
        $this->splittedQuoteExpanderPlugins = $splittedQuoteExpanderPlugins;
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
            $splittedQuoteTransfer = $this->expandSplittedQuote($splittedQuoteTransfer);
            $splittedQuoteTransfer = $this->calculationFacade->recalculateQuote($splittedQuoteTransfer, false);
            $splittableTotalsTransfer->addTotals($key, $splittedQuoteTransfer->getTotals());
        }

        return $splittableTotalsTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandSplittedQuote(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        foreach ($this->splittedQuoteExpanderPlugins as $splittedQuoteExpanderPlugin) {
            $splittedQuoteExpanderPlugin->expand($splittedQuoteTransfer);
        }

        return $splittedQuoteTransfer;
    }
}
