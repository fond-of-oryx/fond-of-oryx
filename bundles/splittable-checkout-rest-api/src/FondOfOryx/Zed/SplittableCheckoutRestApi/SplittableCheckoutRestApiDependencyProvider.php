<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToCartFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_CART = 'FACADE_CART';

    /**
     * @var string
     */
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    /**
     * @var string
     */
    public const FACADE_SPLITTABLE_CHECKOUT = 'FACADE_SPLITTABLE_CHECKOUT';

    /**
     * @var string
     */
    public const FACADE_SPLITTABLE_TOTALS = 'FACADE_SPLITTABLE_TOTALS';

    /**
     * @var string
     */
    public const PLUGINS_QUOTE_EXPANDER = 'PLUGINS_QUOTE_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCartFacade($container);
        $container = $this->addQuoteFacade($container);
        $container = $this->addSplittableCheckoutFacade($container);
        $container = $this->addSplittableTotalsFacade($container);

        return $this->addQuoteExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteFacade(Container $container): Container
    {
        $container[static::FACADE_QUOTE] = static fn (
            Container $container
        ) => new SplittableCheckoutRestApiToQuoteFacadeBridge(
            $container->getLocator()->quote()->facade(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableCheckoutFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_CHECKOUT] = static fn (
            Container $container
        ) => new SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge(
            $container->getLocator()->splittableCheckout()->facade(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableTotalsFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_TOTALS] = static fn (
            Container $container
        ) => new SplittableCheckoutRestApiToSplittableTotalsFacadeBridge(
            $container->getLocator()->splittableTotals()->facade(),
        );

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteExpanderPlugins(Container $container): Container
    {
        $container[static::PLUGINS_QUOTE_EXPANDER] = fn () => $this->getQuoteExpanderPlugins();

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface>
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCartFacade(Container $container): Container
    {
        $container[static::FACADE_CART] = static fn (
            Container $container
        ) => new SplittableCheckoutRestApiToCartFacadeBridge(
            $container->getLocator()->cart()->facade(),
        );

        return $container;
    }
}
