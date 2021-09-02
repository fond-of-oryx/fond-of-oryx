<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender;

use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge;
use FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade\AvailabilityCartDataExtenderToAvailabilityFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityCartDataExtenderDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_AVAILABILITY = 'FACADE_AVAILABILITY';
    public const FACADE_AVAILABILITY_CART_CONNECTOR = 'FACADE_AVAILABILITY_CART_CONNECTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addAvailabilityCartConnectorFacade($container);
        $container = $this->addAvailabilityFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addAvailabilityCartConnectorFacade(Container $container): Container
    {
        $container[static::FACADE_AVAILABILITY_CART_CONNECTOR] = static function (Container $container) {
            return new AvailabilityCartDataExtenderToAvailabilityCartConnectorFacadeBridge(
                $container->getLocator()->availabilityCartConnector()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addAvailabilityFacade(Container $container): Container
    {
        $container[static::FACADE_AVAILABILITY] = static function (Container $container) {
            return new AvailabilityCartDataExtenderToAvailabilityFacadeBridge(
                $container->getLocator()->availability()->facade()
            );
        };

        return $container;
    }
}
