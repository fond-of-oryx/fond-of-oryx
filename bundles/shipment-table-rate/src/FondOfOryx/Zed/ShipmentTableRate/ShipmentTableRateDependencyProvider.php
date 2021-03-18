<?php

namespace FondOfOryx\Zed\ShipmentTableRate;

use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeBridge;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Service\ShipmentTableRateToUtilMathFormulaServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ShipmentTableRateDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COUNTRY = 'FACADE_COUNTRY';
    public const FACADE_STORE = 'FACADE_STORE';

    public const SERVICE_UTIL_MATH_FORMULA = 'SERVICE_UTIL_MATH_FORMULA';

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
        $container = $this->addUtilMathFormulaService($container);

        return $container;
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
                $container->getLocator()->utilMathFormula()->service()
            );
        };

        return $container;
    }
}
