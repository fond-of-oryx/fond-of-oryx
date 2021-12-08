<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business;

use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator\KeyGenerator;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator\KeyGeneratorInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandler;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandler;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\SubscribeToBackInStockHandler;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\SubscribeToBackInStockHandlerInterface;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class AvailabilityAlertCrossEngageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandlerInterface
     */
    public function createRegisterSubscriberHandler(): RegisterSubscriberHandlerInterface
    {
        return new RegisterSubscriberHandler($this->getJellyfishAvailabilityAlertFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\SubscribeToBackInStockHandlerInterface
     */
    public function createSubscribeToBackInStockHandler(): SubscribeToBackInStockHandlerInterface
    {
        return new SubscribeToBackInStockHandler($this->getJellyfishAvailabilityAlertFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandlerInterface
     */
    public function createNotificationHandler(): NotificationHandlerInterface
    {
        return new NotificationHandler($this->getJellyfishAvailabilityAlertFacade());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator\KeyGeneratorInterface
     */
    public function createKeyGenerator(): KeyGeneratorInterface
    {
        return new KeyGenerator($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
     */
    protected function getJellyfishAvailabilityAlertFacade(): AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertCrossEngageDependencyProvider::FACADE_JELLYFISH_AVAILABILITY_ALERT);
    }
}
