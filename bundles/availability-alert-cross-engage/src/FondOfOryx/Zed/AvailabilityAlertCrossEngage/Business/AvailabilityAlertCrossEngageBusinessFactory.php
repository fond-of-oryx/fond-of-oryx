<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandler;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandler;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class AvailabilityAlertCrossEngageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandlerInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createRegisterSubscriberHandler(): RegisterSubscriberHandlerInterface
    {
        return new RegisterSubscriberHandler($this->getJellyfishAvailabilityAlertFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandlerInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createNotificationHandler(): NotificationHandlerInterface
    {
        return new NotificationHandler($this->getJellyfishAvailabilityAlertFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getJellyfishAvailabilityAlertFacade(
    ): AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertCrossEngageDependencyProvider::FACADE_JELLYFISH_AVAILABILITY_ALERT);
    }
}
