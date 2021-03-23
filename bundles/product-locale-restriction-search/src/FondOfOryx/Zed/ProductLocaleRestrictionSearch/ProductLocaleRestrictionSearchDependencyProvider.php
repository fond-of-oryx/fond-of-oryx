<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch;

use FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PRODUCT_LOCALE_RESTRICTION = 'FACADE_PRODUCT_LOCALE_RESTRICTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

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
            return new ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeBridge(
                $container->getLocator()->productLocaleRestriction()->facade()
            );
        };

        return $container;
    }
}
