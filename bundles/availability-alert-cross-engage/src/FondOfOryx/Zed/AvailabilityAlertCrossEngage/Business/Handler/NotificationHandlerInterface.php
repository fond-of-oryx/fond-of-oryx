<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface NotificationHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer
     */
    public function sendSubscription(
        AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
    ): AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
}
