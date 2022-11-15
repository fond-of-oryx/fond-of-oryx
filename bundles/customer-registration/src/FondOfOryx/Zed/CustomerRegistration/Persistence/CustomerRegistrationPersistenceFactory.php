<?php

namespace FondOfOryx\Zed\CustomerRegistration\Persistence;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToCustomerQueryContainerInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToLocaleQueryContainerInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CustomerRegistrationPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToLocaleQueryContainerInterface
     */
    public function getLocaleQueryContainer(): CustomerRegistrationToLocaleQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::QUERY_CONTAINER_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToCustomerQueryContainerInterface
     */
    public function getCustomerQueryContainer(): CustomerRegistrationToCustomerQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::QUERY_CONTAINER_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    public function getLocaleFacade(): CustomerRegistrationToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_LOCALE);
    }
}
