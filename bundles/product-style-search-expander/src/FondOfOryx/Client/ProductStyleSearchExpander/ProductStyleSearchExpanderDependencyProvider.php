<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander;

use FondOfOryx\Client\ProductStyleSearchExpander\Dependency\Client\ProductStyleSearchExpanderToCatalogClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ProductStyleSearchExpanderDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CATALOG = 'CLIENT_CATALOG';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addCatalogSearchClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCatalogSearchClient(Container $container): Container
    {
        $container[static::CLIENT_CATALOG] = function (Container $container) {
            return new ProductStyleSearchExpanderToCatalogClientBridge(
                $container->getLocator()->catalog()->client(),
            );
        };

        return $container;
    }
}
