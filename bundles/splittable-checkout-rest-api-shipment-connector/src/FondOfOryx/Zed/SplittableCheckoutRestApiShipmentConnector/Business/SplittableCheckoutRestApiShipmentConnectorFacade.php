<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorBusinessFactory getFactory()
 */
class SplittableCheckoutRestApiShipmentConnectorFacade extends AbstractFacade implements SplittableCheckoutRestApiShipmentConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createQuoteExpander()
            ->expand($restSplittableCheckoutRequestTransfer, $quoteTransfer);
    }
}
