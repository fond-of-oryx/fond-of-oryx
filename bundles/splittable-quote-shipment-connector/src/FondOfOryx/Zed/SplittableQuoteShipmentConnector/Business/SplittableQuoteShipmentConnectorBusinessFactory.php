<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business;

use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpander;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\SplittableQuoteShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableQuoteShipmentConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpanderInterface
     */
    public function createSplittedQuoteExpander(): SplittedQuoteExpanderInterface
    {
        return new SplittedQuoteExpander(
            $this->getShipmentFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface
     */
    protected function getShipmentFacade(): SplittableQuoteShipmentConnectorToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(
            SplittableQuoteShipmentConnectorDependencyProvider::FACADE_SHIPMENT,
        );
    }
}
