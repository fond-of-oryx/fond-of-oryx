<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Reader;

use FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface
     */
    protected $quoteExpander;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpanderInterface $quoteExpander
     * @param \FondOfOryx\Zed\SplittableTotalsRestApi\Dependency\Facade\SplittableTotalsRestApiToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        QuoteExpanderInterface $quoteExpander,
        SplittableTotalsRestApiToQuoteFacadeInterface $quoteFacade
    ) {
        $this->quoteExpander = $quoteExpander;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getByRestSplittableTotalsRequest(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
    ): ?QuoteTransfer {
        $uuid = $restSplittableTotalsRequestTransfer->getIdCart();
        $idCustomer = $restSplittableTotalsRequestTransfer->getIdCustomer();

        if ($uuid === null || $idCustomer === null) {
            return null;
        }

        $quoteResponseTransfer = $this->quoteFacade->findQuoteByUuid((new QuoteTransfer())->setUuid($uuid));
        $quoteTransfer = $quoteResponseTransfer->getQuoteTransfer();

        if ($quoteTransfer === null || !$quoteResponseTransfer->getIsSuccessful()) {
            return null;
        }

        if ($quoteTransfer->getCustomer() === null || $quoteTransfer->getCustomer()->getIdCustomer() !== $idCustomer) {
            return null;
        }

        return $this->quoteExpander->expand($restSplittableTotalsRequestTransfer, $quoteTransfer);
    }
}
