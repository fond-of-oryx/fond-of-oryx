<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Communication\Plugin\SplittableTotalsExtension;

use FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\SplittableTotalsCompanyUnitAddressConnectorFacadeInterface getFacade()
 */
class CompanyUnitAddressQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFacade()->expandQuote($splittableTotalsRequestTransfer, $quoteTransfer);
    }
}
