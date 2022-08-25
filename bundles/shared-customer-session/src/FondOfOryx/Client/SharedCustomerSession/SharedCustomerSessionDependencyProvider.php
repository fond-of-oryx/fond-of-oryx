<?php

namespace FondOfOryx\Client\SharedCustomerSession;

use FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToCustomerClientBridge;
use FondOfOryx\Client\SharedCustomerSession\Dependency\Client\SharedCustomerSessionToOAuthClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class SharedCustomerSessionDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_OAUTH = 'CLIENT_OAUTH';

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

        $this->addOAuthClient($container);
        $this->addCustomerClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addOAuthClient(Container $container): Container
    {
        $container->set(static::CLIENT_OAUTH, function (Container $container) {
            return new SharedCustomerSessionToOAuthClientBridge($container->getLocator()->oauth()->client());
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
            return new SharedCustomerSessionToCustomerClientBridge($container->getLocator()->customer()->client());
        });

        return $container;
    }
}
