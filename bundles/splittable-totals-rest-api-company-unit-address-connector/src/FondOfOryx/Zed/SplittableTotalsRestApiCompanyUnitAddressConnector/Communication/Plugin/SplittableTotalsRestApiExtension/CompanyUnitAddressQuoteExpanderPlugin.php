<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Communication\Plugin\SplittableTotalsRestApiExtension;

use FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\SplittableTotalsRestApiCompanyUnitAddressConnectorFacadeInterface getFacade()
 */
class CompanyUnitAddressQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFacade()->expandQuote($restSplittableTotalsRequestTransfer, $quoteTransfer);
    }
}
