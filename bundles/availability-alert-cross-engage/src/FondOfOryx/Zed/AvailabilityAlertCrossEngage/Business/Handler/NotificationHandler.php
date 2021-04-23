<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class NotificationHandler implements NotificationHandlerInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface
     */
    protected $jellyfishAvailabilityAlertFacade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
     */
    public function __construct(
        AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface $jellyfishAvailabilityAlertFacade
    ) {
        $this->jellyfishAvailabilityAlertFacade = $jellyfishAvailabilityAlertFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer
     */
    public function sendSubscription(
        AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
    ): AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer {
        $response = new AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer();
        $response->setSubscription($subscriptionTransfer);
        $response->setStatus(true);
        try {
            $this->jellyfishAvailabilityAlertFacade->dispatchSubscription($subscriptionTransfer);
        } catch (Exception $exception) {
            $response->setStatus(false);
        }

        return $response;
    }
}
