<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Communication\Plugin\SplittableTotalsExtension;

use FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\SplittableTotalsShipmentConnectorFacadeInterface getFacade()
 */
class ShipmentSplittedQuoteExpanderPlugin extends AbstractPlugin implements SplittedQuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->expandSplittedQuote($splittedQuoteTransfer);
    }
}
