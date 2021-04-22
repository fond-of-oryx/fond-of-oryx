<?php

namespace FondOfOryx\Zed\SplittableTotals;

use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToCalculationFacadeBridge;
use FondOfOryx\Zed\SplittableTotals\Dependency\Facade\SplittableTotalsToQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CALCULATION = 'FACADE_CALCULATION';
    public const FACADE_QUOTE = 'FACADE_QUOTE';

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
        $container = $this->addCalculationFacade($container);

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
            return new SplittableTotalsToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCalculationFacade(Container $container): Container
    {
        $container[static::FACADE_CALCULATION] = static function (Container $container) {
            return new SplittableTotalsToCalculationFacadeBridge($container->getLocator()->calculation()->facade());
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
     * @return \FondOfOryx\Zed\SplittableTotalsExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return [];
    }
}
