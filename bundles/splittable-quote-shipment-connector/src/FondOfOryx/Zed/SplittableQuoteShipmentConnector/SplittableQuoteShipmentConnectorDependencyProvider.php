<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector;

use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableQuoteShipmentConnectorDependencyProvider extends AbstractBundleDependencyProvider
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
            return new SplittableQuoteShipmentConnectorToShipmentFacadeBridge(
                $container->getLocator()->shipment()->facade()
            );
        };

        return $container;
    }
}
