<?php

namespace FondOfOryx\Zed\SplittableCheckout;

use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\SplittableCheckout\SplittableCheckoutConfig getConfig()
 */
class SplittableCheckoutDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CHECKOUT = 'FACADE_CHECKOUT';
    public const FACADE_PERSISTENT_CART = 'FACADE_PERSISTENT_CART';
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addCheckoutFacade($container);
        $container = $this->addPersistentCartFacade($container);
        $container = $this->addQuoteFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCheckoutFacade(Container $container)
    {
        $container[static::FACADE_CHECKOUT] = function () use ($container) {
            return new SplittableCheckoutToCheckoutFacadeBridge($container->getLocator()->checkout()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPersistentCartFacade(Container $container)
    {
        $container[static::FACADE_PERSISTENT_CART] = function () use ($container) {
            return new SplittableCheckoutToPersistentCartFacadeBridge($container->getLocator()->persistentCart()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteFacade(Container $container)
    {
        $container[static::FACADE_QUOTE] = function () use ($container) {
            return new SplittableCheckoutToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        };

        return $container;
    }
}
