<?php

namespace FondOfOryx\Client\ErpOrderPermission;

use FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ErpOrderPermissionDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addZedRequestClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addZedRequestClient(Container $container)
    {
        $container[static::CLIENT_ZED_REQUEST] = function (Container $container) {
            return new ErpOrderPermissionToZedRequestBridge($container->getLocator()->zedRequest()->client());
        };

        return $container;
    }
}
