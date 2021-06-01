<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business;

use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\Expander\SplittedQuoteExpander;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\SplittableTotalsShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableTotalsShipmentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface
     */
    public function createSplittedQuoteExpander(): SplittedQuoteExpanderInterface
    {
        return new SplittedQuoteExpander(
            $this->getShipmentFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeInterface
     */
    protected function getShipmentFacade(): SplittableTotalsShipmentConnectorToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(
            SplittableTotalsShipmentConnectorDependencyProvider::FACADE_SHIPMENT
        );
    }
}
