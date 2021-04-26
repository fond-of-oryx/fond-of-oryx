<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\SplittableTotalsRestApiCompanyUnitAddressConnectorBusinessFactory getFactory()
 */
class SplittableTotalsRestApiCompanyUnitAddressConnectorFacade extends AbstractFacade implements
    SplittableTotalsRestApiCompanyUnitAddressConnectorFacadeInterface
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
        return $this->getFactory()->createQuoteExpander()->expand($restSplittableTotalsRequestTransfer, $quoteTransfer);
    }
}
