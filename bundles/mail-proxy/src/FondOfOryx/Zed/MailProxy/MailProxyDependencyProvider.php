<?php

namespace FondOfOryx\Zed\MailProxy;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class MailProxyDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_MAIL_EXPANDER = 'PLUGINS_MAIL_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        return $this->addMailExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_MAIL_EXPANDER] = function () {
            return $this->getMailExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface>
     */
    protected function getMailExpanderPlugins(): array
    {
        return [];
    }
}
