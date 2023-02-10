<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector;

use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeBridge;
use FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Dependency\Facade\CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationOneTimePasswordConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ONE_TIME_PASSWORD = 'FACADE_ONE_TIME_PASSWORD';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const PLUGINS_ONE_TIME_PASSWORD_PRE = 'PLUGINS_ONE_TIME_PASSWORD_PRE';

    /**
     * @var string
     */
    public const PLUGINS_ONE_TIME_PASSWORD_POST = 'PLUGINS_ONE_TIME_PASSWORD_POST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOneTimePasswordFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addOneTimePasswordPostPlugins($container);
        $container = $this->addOneTimePasswordPreConditionPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOneTimePasswordFacade(Container $container): Container
    {
        $container[static::FACADE_ONE_TIME_PASSWORD] = static function (Container $container) {
            return new CustomerRegistrationToOneTimePasswordFacadeBridge(
                $container->getLocator()->oneTimePassword()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container[static::FACADE_LOCALE] = static function (Container $container) {
            return new CustomerRegistrationOneTimePasswordConnectorToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOneTimePasswordPreConditionPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_ONE_TIME_PASSWORD_PRE] = static function () use ($self) {
            return $self->getOneTimePasswordPreConditionPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOneTimePasswordPostPlugins(Container $container): Container
    {
        $self = $this;
        $container[static::PLUGINS_ONE_TIME_PASSWORD_POST] = static function () use ($self) {
            return $self->getOneTimePasswordPostPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected function getOneTimePasswordPreConditionPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected function getOneTimePasswordPostPlugins(): array
    {
        return [];
    }
}
