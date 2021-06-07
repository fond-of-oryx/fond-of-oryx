<?php

namespace FondOfOryx\Zed\SplittableQuote;

use FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableQuoteDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CALCULATION = 'FACADE_CALCULATION';

    public const PLUGINS_SPLITTED_QUOTE_EXPANDER = 'PLUGINS_SPLITTED_QUOTE_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCalculationFacade($container);

        return $this->addSplittedQuoteExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCalculationFacade(Container $container): Container
    {
        $container[static::FACADE_CALCULATION] = static function (Container $container) {
            return new SplittableQuoteToCalculationFacadeBridge($container->getLocator()->calculation()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSplittedQuoteExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SPLITTED_QUOTE_EXPANDER] = static function () use ($self) {
            return $self->getSplittedQuoteExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface[]
     */
    protected function getSplittedQuoteExpanderPlugins(): array
    {
        return [];
    }
}
