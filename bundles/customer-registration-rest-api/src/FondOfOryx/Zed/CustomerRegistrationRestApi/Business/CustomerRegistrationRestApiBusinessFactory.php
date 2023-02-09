<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business;

use FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor\CustomerRegistrationProcessor;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor\CustomerRegistrationProcessorInterface;
use FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig getConfig()
 */
class CustomerRegistrationRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor\CustomerRegistrationProcessorInterface
     */
    public function createCustomerRegistrationProcessor(): CustomerRegistrationProcessorInterface
    {
        return new CustomerRegistrationProcessor(
            $this->getCustomerFacade(),
            $this->getOneTimePasswordFacade(),
            $this->getMailFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerRegistrationRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): CustomerRegistrationRestApiToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeInterface
     */
    protected function getMailFacade(): CustomerRegistrationRestApiToMailFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::FACADE_MAIL);
    }
}
