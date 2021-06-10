<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\SplittableQuoteShipmentConnectorBusinessFactory getFactory()
 */
class SplittableQuoteShipmentConnectorFacade extends AbstractFacade implements SplittableQuoteShipmentConnectorFacadeInterface
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
