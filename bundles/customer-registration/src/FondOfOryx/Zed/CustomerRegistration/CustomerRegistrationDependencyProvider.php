<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToOneTimePasswordFacadeBridge;
use FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToCustomerQueryContainerBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @var string
     */
    public const FACADE_ONE_TIME_PASSWORD = 'FACADE_ONE_TIME_PASSWORD';

    /**
     * @var string
     */
    public const QUERY_CONTAINER_CUSTOMER = 'QUERY_CONTAINER_CUSTOMER';

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

        $container = $this->addCustomerFacade($container);
        $container = $this->addMailFacade($container);

        return $this->addOneTimePasswordFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addCustomerFacade($container);
        $container = $this->addMailFacade($container);

        return $this->addOneTimePasswordFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addCustomerQueryContainer($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = static function (Container $container) {
            return new CustomerRegistrationToCustomerFacadeBridge(
                $container->getLocator()->customer()->facade(),
            );
        };

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
    protected function addCustomerQueryContainer(Container $container): Container
    {
        $container[static::QUERY_CONTAINER_CUSTOMER] = static function (Container $container) {
            return new CustomerRegistrationToCustomerQueryContainerBridge(
                $container->getLocator()->customer()->queryContainer(),
            );
        };

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
            return new CustomerRegistrationToMailFacadeBridge(
                $container->getLocator()->mail()->facade(),
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
            return new CustomerRegistrationToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade(),
            );
        };

        return $container;
    }
}
