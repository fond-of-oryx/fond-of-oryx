<?php

namespace FondOfOryx\Client\CustomerTokenManager;

use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientBridge;
use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthClientBridge;
use FondOfOryx\Client\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToOauthServiceBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class CustomerTokenManagerDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_OAUTH = 'CLIENT_OAUTH';

    /**
     * @var string
     */
    public const SERVICE_OAUTH = 'SERVICE_OAUTH';

    /**
     * @var string
     */
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $this->addOauthClient($container);
        $this->addOauthService($container);
        $this->addCustomerClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addOauthClient(Container $container): Container
    {
        $container->set(static::CLIENT_OAUTH, function (Container $container) {
            return new CustomerTokenManagerToOauthClientBridge($container->getLocator()->oauth()->client());
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addOAuthService(Container $container): Container
    {
        $container->set(static::SERVICE_OAUTH, function (Container $container) {
            return new CustomerTokenManagerToOauthServiceBridge($container->getLocator()->oauth()->service());
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCustomerClient(Container $container): Container
    {
        $container->set(static::CLIENT_CUSTOMER, function (Container $container) {
            return new CustomerTokenManagerToCustomerClientBridge($container->getLocator()->customer()->client());
        });

        return $container;
    }
}
