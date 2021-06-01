<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableTotalsRestApiShipmentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander();
    }
}
