<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business;

use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessor;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\CustomerRegistrationSalesConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerRegistrationSalesConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface
     */
    public function createRegistrationProcessor(): RegistrationProcessorInterface
    {
        return new RegistrationProcessor($this->getCustomerFacade());
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationSalesConnectorToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerRegistrationSalesConnectorToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationSalesConnectorDependencyProvider::FACADE_CUSTOMER);
    }
}
