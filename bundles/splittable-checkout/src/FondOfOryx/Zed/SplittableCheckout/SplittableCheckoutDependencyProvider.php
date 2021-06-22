<?php

namespace FondOfOryx\Zed\SplittableCheckout;

use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToSplittableQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CHECKOUT = 'FACADE_CHECKOUT';
    public const FACADE_QUOTE = 'FACADE_QUOTE';
    public const FACADE_SPLITTABLE_QUOTE = 'FACADE_SPLITTABLE_QUOTE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCheckoutFacade($container);
        $container = $this->addSplittableQuoteFacade($container);

        return $this->addQuoteFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCheckoutFacade(Container $container): Container
    {
        $container[static::FACADE_CHECKOUT] = static function () use ($container) {
            return new SplittableCheckoutToCheckoutFacadeBridge($container->getLocator()->checkout()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_QUOTE] = static function () use ($container) {
            return new SplittableCheckoutToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_QUOTE] = static function () use ($container) {
            return new SplittableCheckoutToSplittableQuoteFacadeBridge(
                $container->getLocator()->splittableQuote()->facade()
            );
        };

        return $container;
    }
}
