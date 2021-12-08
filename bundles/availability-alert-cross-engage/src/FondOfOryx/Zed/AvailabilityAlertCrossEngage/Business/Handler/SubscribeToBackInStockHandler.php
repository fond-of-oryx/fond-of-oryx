<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class SubscribeToBackInStockHandler implements SubscribeToBackInStockHandlerInterface
{
    /**
     * @var string
     */
    protected const EVENT_TYPE = 'subscribed-to-back-in-stock';

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
    public function sendSubscribeToBackInStockEvent(
        AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
    ): AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer {
        $response = new AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer();
        $response->setSubscription($subscriptionTransfer);
        $response->setStatus(true);

        $subscriptionTransfer->setEventType(static::EVENT_TYPE);
        try {
            $this->jellyfishAvailabilityAlertFacade->dispatchSubscription($subscriptionTransfer);
        } catch (Exception $exception) {
            $response->setStatus(false);
        }

        return $response;
    }
}
