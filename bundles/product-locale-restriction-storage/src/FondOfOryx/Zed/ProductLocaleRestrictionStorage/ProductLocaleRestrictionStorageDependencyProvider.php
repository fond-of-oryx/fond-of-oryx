<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage;

use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeBridge;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionStorageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

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
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addEventBehaviorFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT_BEHAVIOR] = static function (Container $container) {
            return new ProductLocaleRestrictionStorageToEventBehaviorFacadeBridge(
                $container->getLocator()->eventBehavior()->facade(),
            );
        };

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
            return new ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeBridge(
                $container->getLocator()->productLocaleRestriction()->facade(),
            );
        };

        return $container;
    }
}
