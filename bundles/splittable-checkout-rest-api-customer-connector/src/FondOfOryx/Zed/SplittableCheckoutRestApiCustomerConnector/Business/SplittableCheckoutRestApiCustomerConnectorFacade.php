<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Business\SplittableCheckoutRestApiCustomerConnectorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorRepositoryInterface getRepository()
 */
class SplittableCheckoutRestApiCustomerConnectorFacade extends AbstractFacade implements SplittableCheckoutRestApiCustomerConnectorFacadeInterface
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
