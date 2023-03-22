<?php

namespace FondOfOryx\Zed\OneTimePasswordEmailConnector\Business;

use FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorLoginLinkMailTypePlugin;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorMailTypeBuilderPlugin;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\Communication\Plugin\Mail\OneTimePasswordEmailConnectorMailTypePlugin;
use FondOfOryx\Zed\OneTimePasswordEmailConnector\OneTimePasswordEmailConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface;

class OneTimePasswordEmailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\OneTimePasswordEmailConnectorInterface
     */
    public function createOneTimePasswordEmailConnector(): OneTimePasswordEmailConnectorInterface
    {
        return new OneTimePasswordEmailConnector(
            $this->getMailFacade(),
            $this->getMailTypes(),
        );
    }

    /**
     * @return array<string>
     */
    public function getMailTypes(): array
    {
        if (class_exists(MailTypeBuilderPluginInterface::class)) {
            return [
                OneTimePasswordEmailConnector::MAIL_TYPE => OneTimePasswordEmailConnectorMailTypeBuilderPlugin::MAIL_TYPE,
                OneTimePasswordEmailConnector::MAIL_TYPE_LOGIN_LINK => OneTimePasswordEmailConnectorLoginLinkMailTypeBuilderPlugin::MAIL_TYPE,
            ];
        }

        return [
            OneTimePasswordEmailConnector::MAIL_TYPE => OneTimePasswordEmailConnectorMailTypePlugin::MAIL_TYPE,
            OneTimePasswordEmailConnector::MAIL_TYPE_LOGIN_LINK => OneTimePasswordEmailConnectorLoginLinkMailTypePlugin::MAIL_TYPE,
        ];
    }

    /**
     * @return \FondOfOryx\Zed\OneTimePasswordEmailConnector\Business\Dependency\Facade\OneTimePasswordEmailConnectorToMailBridge
     */
    protected function getMailFacade(): OneTimePasswordEmailConnectorToMailBridge
    {
        return $this->getProvidedDependency(OneTimePasswordEmailConnectorDependencyProvider::FACADE_MAIL);
    }
}
