<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscribeToBackInStockHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer
     */
    public function sendSubscribeToBackInStockEvent(
        AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
    ): AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
}
