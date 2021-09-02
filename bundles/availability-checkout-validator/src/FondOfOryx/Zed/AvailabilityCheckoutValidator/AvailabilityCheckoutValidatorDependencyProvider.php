<?php

namespace FondOfOryx\Zed\AvailabilityCheckoutValidator;

use FondOfOryx\Zed\AvailabilityCheckoutValidator\Dependency\Facade\AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityCheckoutValidatorDependencyProvider extends AbstractBundleDependencyProvider
{
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
            return new AvailabilityCheckoutValidatorToAvailabilityCartDataExtenderFacadeBridge(
                $container->getLocator()->availabilityCartDataExtender()->facade()
            );
        };

        return $container;
    }
}
