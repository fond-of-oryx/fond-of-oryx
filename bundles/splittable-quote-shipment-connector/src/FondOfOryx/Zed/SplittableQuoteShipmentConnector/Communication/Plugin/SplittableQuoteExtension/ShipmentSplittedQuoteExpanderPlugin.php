<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Communication\Plugin\SplittableQuoteExtension;

use FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\SplittableQuoteShipmentConnectorFacadeInterface getFacade()
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
