<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface;
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

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    public function getLocaleFacade(): CustomerRegistrationToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_LOCALE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToStoreFacadeInterface
     */
    public function getStoreFacade(): CustomerRegistrationToStoreFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    public function getMailFacade(): CustomerRegistrationToMailFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    public function getOneTimePasswordFacade(): CustomerRegistrationToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }
}
