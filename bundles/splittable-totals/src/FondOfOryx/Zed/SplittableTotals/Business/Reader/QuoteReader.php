<?php

namespace FondOfOryx\Zed\SplittableTotals\Business\Reader;

use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected $quoteExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeInterface $quoteFacade
     * @param \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface[] $quoteExpanderPlugins
     */
    public function __construct(
        SplittableTotalsToQuoteFacadeInterface $quoteFacade,
        array $quoteExpanderPlugins = []
    ) {
        $this->quoteFacade = $quoteFacade;
        $this->quoteExpanderPlugins = $quoteExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getBySplittableTotalsRequest(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?QuoteTransfer {
        $idQuote = $splittableTotalsRequestTransfer->getIdCart();

        if ($idQuote === null) {
            return null;
        }

        $quoteResponseTransfer = $this->quoteFacade->findQuoteById($idQuote);
        $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();

        if ($quoteTransfer === null || !$quoteResponseTransfer->getIsSuccessful()) {
            return null;
        }

        foreach ($this->quoteExpanderPlugins as $quoteExpanderPlugin) {
            $quoteTransfer = $quoteExpanderPlugin->expandQuote($splittableTotalsRequestTransfer, $quoteTransfer);
        }

        return $quoteTransfer;
    }
}
