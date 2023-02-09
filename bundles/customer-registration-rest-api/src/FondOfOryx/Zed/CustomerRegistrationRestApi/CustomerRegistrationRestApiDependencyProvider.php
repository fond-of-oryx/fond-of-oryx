<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi;

use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToCustomerFacadeBridge;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToMailFacadeBridge;
use FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade\CustomerRegistrationRestApiToOneTimePasswordFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerRegistrationRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_ONE_TIME_PASSWORD = 'FACADE_ONE_TIME_PASSWORD';

    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addCustomerFacade($container);
        $container = $this->addOneTimePasswordFacade($container);
        $container = $this->addMailFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container[static::FACADE_CUSTOMER] = static function (Container $container) {
            return new CustomerRegistrationRestApiToCustomerFacadeBridge(
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
            return new CustomerRegistrationRestApiToOneTimePasswordFacadeBridge(
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
    protected function addMailFacade(Container $container): Container
    {
        $container[static::FACADE_MAIL] = static function (Container $container) {
            return new CustomerRegistrationRestApiToMailFacadeBridge(
                $container->getLocator()->mail()->facade(),
            );
        };

        return $container;
    }
}
