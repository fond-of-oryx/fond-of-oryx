<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\SplittableTotalsRestApiShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableTotalsRestApiShipmentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->getShipmentFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface
     */
    protected function getShipmentFacade(): SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(
            SplittableTotalsRestApiShipmentConnectorDependencyProvider::FACADE_SHIPMENT
        );
    }
}
