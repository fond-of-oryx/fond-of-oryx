<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishSalesOrderGiftCardConnectorDependencyProvider extends AbstractBundleDependencyProvider
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

        $container = $this->addProductCartCodeTypeRestrictionFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductCartCodeTypeRestrictionFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION] = static function () use ($container) {
            return new JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge(
                $container->getLocator()->productCartCodeTypeRestriction()->facade(),
            );
        };

        return $container;
    }
}
