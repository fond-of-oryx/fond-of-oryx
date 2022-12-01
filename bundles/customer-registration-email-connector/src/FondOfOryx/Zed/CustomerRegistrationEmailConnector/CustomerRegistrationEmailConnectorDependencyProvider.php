<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector;

use FondOfOryx\Zed\CustomerRegistrationEmailConnector\Dependency\Facade\CustomerRegistrationEmailConnectorToMailBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationEmailConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @var string
     */
    public const PLUGINS_MAIL_CONNECTOR_PRE = 'PLUGINS_MAIL_CONNECTOR_PRE';

    /**
     * @var string
     */
    public const PLUGINS_MAIL_CONNECTOR_POST = 'PLUGINS_MAIL_CONNECTOR_POST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addMailFacade($container);
        $container = $this->addMailConnectorPostPlugins($container);
        $container = $this->addMailConnectorPreConditionPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailFacade(Container $container): Container
    {
        $container[static::FACADE_MAIL] = static function (Container $container) {
            return new CustomerRegistrationEmailConnectorToMailBridge($container->getLocator()->mail()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailConnectorPreConditionPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_MAIL_CONNECTOR_PRE] = static function () use ($self) {
            return $self->getMailConnectorPreConditionPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailConnectorPostPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_MAIL_CONNECTOR_POST] = static function () use ($self) {
            return $self->getMailConnectorPostPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getMailConnectorPreConditionPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getMailConnectorPostPlugins(): array
    {
        return [];
    }
}
