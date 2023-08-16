<?php

namespace FondOfOryx\Zed\ShipmentTableRate;

use FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculator\NoShipmentPriceCalculatorPlugin;
use FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\ShipmentTableRateExtension\PriceToPayFilterPlugin;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceBridge;
use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_COUNTRY = 'FACADE_COUNTRY';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @var string
     */
    public const PLUGIN_PRICE_TO_PAY_FILTER = 'PLUGIN_PRICE_TO_PAY_FILTER';

    /**
     * @var string
     */
    public const SERVICE_UTIL_MATH_FORMULA = 'SERVICE_UTIL_MATH_FORMULA';

    /**
     * @var string
     */
    public const PLUGINS_PRICE_CALCULATOR = 'PLUGINS_PRICE_CALCULATOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCountryFacade($container);
        $container = $this->addStoreFacade($container);
        $container = $this->addPriceCalculatorPlugins($container);
        $container = $this->addUtilMathFormulaService($container);

        return $this->addPriceToPayFilterPlugin($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCountryFacade(Container $container): Container
    {
        $container[static::FACADE_COUNTRY] = static function (Container $container) {
            return new ShipmentTableRateToCountryFacadeBridge($container->getLocator()->country()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = static function (Container $container) {
            return new ShipmentTableRateToStoreFacadeBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilMathFormulaService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_MATH_FORMULA] = static function (Container $container) {
            return new ShipmentTableRateToUtilMathFormulaServiceBridge(
                $container->getLocator()->utilMathFormula()->service(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceToPayFilterPlugin(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGIN_PRICE_TO_PAY_FILTER] = static function () use ($self) {
            return $self->getPriceToPayFilterPlugin();
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface
     */
    protected function getPriceToPayFilterPlugin(): PriceToPayFilterPluginInterface
    {
        return new PriceToPayFilterPlugin();
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceCalculatorPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_PRICE_CALCULATOR] = static function () use ($self) {
            return $self->getPriceCalculatorPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Zed\ShipmentTableRate\Communication\Plugin\PriceCalculator\PriceCalculatorPluginInterface>
     */
    protected function getPriceCalculatorPlugins(): array
    {
        return [
            new NoShipmentPriceCalculatorPlugin(),
        ];
    }
}
