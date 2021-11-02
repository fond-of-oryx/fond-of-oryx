<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AvailabilityAlertCrossEngageDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_CROSS_ENGAGE = 'SERVICE_CROSS_ENGAGE';

    /**
     * @var string
     */
    public const FACADE_JELLYFISH_AVAILABILITY_ALERT = 'FACADE_JELLYFISH_AVAILABILITY_ALERT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addCrossEngageService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addJellyfishAvailabilityAlertFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addCrossEngageService(Container $container): Container
    {
        $container[static::SERVICE_CROSS_ENGAGE] = static function (Container $container) {
            return new AvailabilityAlertCrossEngageToCrossEngageServiceBridge($container->getLocator()->crossEngage()->service());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addJellyfishAvailabilityAlertFacade(Container $container): Container
    {
        $container[static::FACADE_JELLYFISH_AVAILABILITY_ALERT] = static function (Container $container) {
            return new AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge($container->getLocator()->jellyfishAvailabilityAlert()->facade());
        };

        return $container;
    }
}
