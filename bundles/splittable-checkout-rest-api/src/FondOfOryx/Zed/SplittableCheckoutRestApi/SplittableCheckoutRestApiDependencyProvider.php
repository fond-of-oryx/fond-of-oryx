<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi;

use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToQuoteFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge;
use FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade\SplittableCheckoutRestApiToSplittableTotalsFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_QUOTE = 'FACADE_QUOTE';
    public const FACADE_SPLITTABLE_CHECKOUT = 'FACADE_SPLITTABLE_CHECKOUT';
    public const FACADE_SPLITTABLE_TOTALS = 'FACADE_SPLITTABLE_TOTALS';

    public const PLUGINS_QUOTE_EXPANDER = 'PLUGINS_QUOTE_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

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
        $container[static::FACADE_QUOTE] = static function (Container $container) {
            return new SplittableCheckoutRestApiToQuoteFacadeBridge(
                $container->getLocator()->quote()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableCheckoutFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_CHECKOUT] = static function (Container $container) {
            return new SplittableCheckoutRestApiToSplittableCheckoutFacadeBridge(
                $container->getLocator()->splittableCheckout()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittableTotalsFacade(Container $container): Container
    {
        $container[static::FACADE_SPLITTABLE_TOTALS] = static function (Container $container) {
            return new SplittableCheckoutRestApiToSplittableTotalsFacadeBridge(
                $container->getLocator()->splittableTotals()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_QUOTE_EXPANDER] = static function () use ($self) {
            return $self->getQuoteExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return [];
    }
}
