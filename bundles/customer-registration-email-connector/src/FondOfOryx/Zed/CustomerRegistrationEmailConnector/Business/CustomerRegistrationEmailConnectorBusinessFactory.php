<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSender;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\CustomerRegistrationEmailConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerRegistrationEmailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface
     */
    public function createWelcomeMailSender(): WelcomeMailSenderInterface
    {
        return new WelcomeMailSender(
            $this->getMailFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface
     */
    protected function getMailFacade(): CustomerRegistrationEmailConnectorToMailInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationEmailConnectorDependencyProvider::FACADE_MAIL);
    }
}
