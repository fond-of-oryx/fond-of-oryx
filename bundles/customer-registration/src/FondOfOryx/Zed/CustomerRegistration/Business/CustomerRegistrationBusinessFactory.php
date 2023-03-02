<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business;

use FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationHandler;
use FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationHandlerInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Sender\WelcomeMailSender;
use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationDependencyProvider;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfig getConfig()
 */
class CustomerRegistrationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Processor\CustomerRegistrationHandlerInterface
     */
    public function createCustomerRegistrationHandler(): CustomerRegistrationHandlerInterface
    {
        return new CustomerRegistrationHandler(
            $this->getCustomerFacade(),
            $this->getOneTimePasswordFacade(),
            $this->getMailfacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Business\Sender\WelcomeMailSender
     */
    public function createWelcomeMail(): WelcomeMailSender
    {
        return new WelcomeMailSender(
            $this->getMailfacade(),
            $this->getOneTimePasswordFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerRegistrationToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    protected function getMailfacade(): CustomerRegistrationToMailFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeInterface
     */
    protected function getOneTimePasswordFacade(): CustomerRegistrationToOneTimePasswordFacadeInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationDependencyProvider::FACADE_ONE_TIME_PASSWORD);
    }
}
