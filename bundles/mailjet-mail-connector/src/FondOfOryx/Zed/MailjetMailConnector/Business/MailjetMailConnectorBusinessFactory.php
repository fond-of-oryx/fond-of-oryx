<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business;

use FondOfOryx\Zed\MailjetMailConnector\MailjetMailConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface;

class MailjetMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Spryker\Zed\MailExtension\Dependency\Plugin\MailProviderPluginInterface
     */
    public function getMailerProvider(): MailProviderPluginInterface
    {
        return $this->getProvidedDependency(MailjetMailConnectorDependencyProvider::MAILER_PROVIDER_MAILJET);
    }
}
