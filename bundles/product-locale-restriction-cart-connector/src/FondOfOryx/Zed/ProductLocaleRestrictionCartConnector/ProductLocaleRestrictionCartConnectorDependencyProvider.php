<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionCartConnector;

use FondOfOryx\Zed\ProductLocaleRestrictionCartConnector\Dependency\Facade\ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionCartConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_LOCALE_RESTRICTION = 'FACADE_PRODUCT_LOCALE_RESTRICTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductLocaleRestrictionFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductLocaleRestrictionFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_LOCALE_RESTRICTION] = static function (Container $container) {
            return new ProductLocaleRestrictionCartConnectorToProductLocaleRestrictionFacadeBridge(
                $container->getLocator()->productLocaleRestriction()->facade(),
            );
        };

        return $container;
    }
}
