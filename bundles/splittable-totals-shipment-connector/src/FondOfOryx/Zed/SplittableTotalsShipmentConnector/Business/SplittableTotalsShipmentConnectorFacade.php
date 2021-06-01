<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\SplittableTotalsShipmentConnectorBusinessFactory getFactory()
 */
class SplittableTotalsShipmentConnectorFacade extends AbstractFacade implements SplittableTotalsShipmentConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandSplittedQuote(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        return $this->getFactory()
            ->createSplittedQuoteExpander()
            ->expand($splittedQuoteTransfer);
    }
}
