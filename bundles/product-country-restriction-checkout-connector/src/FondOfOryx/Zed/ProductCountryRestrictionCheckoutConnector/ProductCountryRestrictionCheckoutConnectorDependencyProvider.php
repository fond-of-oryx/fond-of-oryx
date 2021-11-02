<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector;

use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Dependency\Facade\ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductCountryRestrictionCheckoutConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_COUNTRY_RESTRICTION = 'FACADE_PRODUCT_COUNTRY_RESTRICTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addProductCountryRestrictionFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCountryRestrictionFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_COUNTRY_RESTRICTION] = static function (Container $container) {
            return new ProductCountryRestrictionCheckoutConnectorToProductCountryRestrictionFacadeBridge(
                $container->getLocator()->productCountryRestriction()->facade(),
            );
        };

        return $container;
    }
}
