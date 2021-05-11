<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector;

use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsRestApiShipmentConnectorDependencyProvider extends AbstractBundleDependencyProvider
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
            return new SplittableTotalsRestApiShipmentConnectorToShipmentFacadeBridge(
                $container->getLocator()->shipment()->facade()
            );
        };

        return $container;
    }
}
