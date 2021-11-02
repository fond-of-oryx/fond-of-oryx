<?php

namespace FondOfOryx\Zed\OneTimePassword;

use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOneTimePasswordEmailConnectorFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeBridge;
use FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const QUERY_CONTAINER_CUSTOMER = 'QUERY_CONTAINER_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR = 'FACADE_ONE_TIME_PASSWORD_EMAIL_CONNECTOR';

    /**
     * @var string
     */
    public const FACADE_OAUTH = 'FACADE_OAUTH';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addOneTimePasswordEmailConnectorFacade($container);
        $container = $this->addOauthFacade($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addLocaleFacade($container);

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
                $container->getLocator()->oneTimePasswordEmailConnector()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addOauthFacade(Container $container): Container
    {
        $container[static::FACADE_OAUTH] = static function (Container $container) {
            return new OneTimePasswordToOauthFacadeBridge(
                $container->getLocator()->oauth()->facade(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new OneTimePasswordToStoreFacadeBridge(
                $container->getLocator()->store()->facade(),
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
            return new OneTimePasswordToLocaleFacadeBridge(
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
                $container->getLocator()->customer()->queryContainer(),
            );
        };

        return $container;
    }
}
