<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander;

use FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductPageSearchAttributeExpanderDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_ATTRIBUTE = 'FACADE_PRODUCT_ATTRIBUTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductAttributeFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAttributeFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_ATTRIBUTE] = function (Container $container) {
            return new ProductPageSearchAttributeExpanderToProductAttributeFacadeBridge(
                $container->getLocator()->productAttribute()->facade(),
            );
        };

        return $container;
    }
}
