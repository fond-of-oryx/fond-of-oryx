<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector;

use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsShipmentConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_SHIPMENT = 'FACADE_SHIPMENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addShipmentFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addShipmentFacade(Container $container): Container
    {
        $container[static::FACADE_SHIPMENT] = static function (Container $container) {
            return new SplittableTotalsShipmentConnectorToShipmentFacadeBridge(
                $container->getLocator()->shipment()->facade()
            );
        };

        return $container;
    }
}
