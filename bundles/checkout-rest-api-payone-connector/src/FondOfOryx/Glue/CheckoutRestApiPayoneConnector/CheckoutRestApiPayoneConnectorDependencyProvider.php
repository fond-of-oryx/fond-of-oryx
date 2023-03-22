<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector;

use FondOfOryx\Glue\CheckoutRestApiPayoneConnector\Dependency\CheckoutRestApiPayoneConnectorToStoreClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CheckoutRestApiPayoneConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const STORE_CLIENT = 'CHECKOUT_REST_API_PAYONE_CONNECTOR:STORE_CLIENT';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addStoreClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addStoreClient(Container $container): Container
    {
        $container->set(static::STORE_CLIENT, function (Container $container) {
            return new CheckoutRestApiPayoneConnectorToStoreClientBridge($container->getLocator()->store()->client());
        });

        return $container;
    }
}
