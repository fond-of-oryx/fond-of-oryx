<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSender;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Sender\WelcomeMailSenderInterface;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStep;
use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStepInterface;
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
     * @return \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps\WelcomeMailSenderStepInterface
     */
    public function createWelcomeMailSenderStep(): WelcomeMailSenderStepInterface
    {
        return new WelcomeMailSenderStep(
            $this->createWelcomeMailSender(),
            $this->getEmailConnectorPreConditionPlugins(),
            $this->getEmailConnectorPostPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailInterface
     */
    protected function getMailFacade(): CustomerRegistrationEmailConnectorToMailInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationEmailConnectorDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getEmailConnectorPreConditionPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationEmailConnectorDependencyProvider::PLUGINS_MAIL_CONNECTOR_PRE);
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getEmailConnectorPostPlugins(): array
    {
        return $this->getProvidedDependency(CustomerRegistrationEmailConnectorDependencyProvider::PLUGINS_MAIL_CONNECTOR_POST);
    }
}
