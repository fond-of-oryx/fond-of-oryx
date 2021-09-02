<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Business;

use FondOfOryx\Zed\AvailabilityCartDataExtender\AvailabilityCartDataExtenderDependencyProvider;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart\CheckCartAvailability;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AvailabilityCartDataExtenderBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityCartDataExtender\Business\Cart\CheckCartAvailabilityInterface
     */
    public function createCartCheckAvailability()
    {
        return new CheckCartAvailability($this->getAvailabilityCartConnectorFacade(), $this->getAvailabilityFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeInterface
     */
    protected function getAvailabilityFacade(): AvailabilityCartDataExtenderToAvailabilityFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityCartDataExtenderDependencyProvider::FACADE_AVAILABILITY);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface
     */
    protected function getAvailabilityCartConnectorFacade(): AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityCartDataExtenderDependencyProvider::FACADE_AVAILABILITY_CART_CONNECTOR);
    }
}
