<?php

namespace FondOfOryx\Zed\OneTimePassword;

use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_CUSTOMER = 'QUERY_CONTAINER_CUSTOMER';
    public const FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR = 'FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOneTimePasswordEmailConnectorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOneTimePasswordEmailConnectorFacade(Container $container): Container
    {
        $container[static::FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR] = static function (Container $container) {
            return new OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge(
                $container->getLocator()->oneTimePasswordEmailConnector()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container = $this->addCustomerQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_CUSTOMER] = static function (Container $container) {
            return new OneTimePasswordToCustomerQueryContainerBridge(
                $container->getLocator()->customer()->queryContainer()
            );
        };

        return $container;
    }
}
