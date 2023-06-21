<?php

namespace FondOfOryx\Zed\MailProxy\Communication;

use FondOfOryx\Zed\MailProxy\MailProxyDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class MailProxyCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return array<\FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface>
     */
    public function getMailExpanderPlugins(): array
    {
        return $this->getProvidedDependency(MailProxyDependencyProvider::PLUGINS_MAIL_EXPANDER);
    }
}
