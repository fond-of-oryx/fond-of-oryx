<?php

namespace FondOfOryx\Glue\PayoneRestApi;

use FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class PayoneRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_PAYONE = 'CLIENT_PAYONE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addPayoneClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addPayoneClient(Container $container): Container
    {
        $container->set(static::CLIENT_PAYONE, function (Container $container) {
            return new PayoneRestApiToPayoneClientBridge($container->getLocator()->payone()->client());
        });

        return $container;
    }
}
