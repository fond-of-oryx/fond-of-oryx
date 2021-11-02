<?php

namespace FondOfOryx\Zed\GiftCardRestriction;

use FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade\GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardRestrictionDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION = 'FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addProductCartCodeTypeRestrictionFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCartCodeTypeRestrictionFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION] = static function (Container $container) {
            return new GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeBridge(
                $container->getLocator()->productCartCodeTypeRestriction()->facade(),
            );
        };

        return $container;
    }
}
