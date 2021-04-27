<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade;

use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\JellyfishAvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge implements AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\JellyfishAvailabilityAlertFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\JellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
     */
    public function __construct(JellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade)
    {
        $this->facade = $jellyfishAvailabilityAlertFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return void
     */
    public function dispatchSubscriber(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): void
    {
        $this->facade->dispatchSubscriber($availabilityAlertSubscriberTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function dispatchSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->facade->dispatchSubscription($availabilityAlertSubscriptionTransfer);
    }
}
