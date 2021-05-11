<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorBusinessFactory getFactory()
 */
class SplittableTotalsRestApiShipmentConnectorFacade extends AbstractFacade implements SplittableTotalsRestApiShipmentConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createQuoteExpander()
            ->expand($restSplittableTotalsRequestTransfer, $quoteTransfer);
    }
}
