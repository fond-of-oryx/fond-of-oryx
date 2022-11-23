<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CustomerRegistrationCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomerRegistrationToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_CUSTOMER);
    }
}
