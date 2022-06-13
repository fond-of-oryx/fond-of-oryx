<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class GiftCardProportionalValueDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_PROPORTIONAL_VALUE_CALCULATION = 'PLUGINS_PROPORTIONAL_VALUE_CALCULATION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addProportionalValueCalulationPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProportionalValueCalulationPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PROPORTIONAL_VALUE_CALCULATION, function () {
            return $this->getProportionalValueCalulationPlugins();
        });

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface>
     */
    protected function getProportionalValueCalulationPlugins(): array
    {
        return [];
    }
}
