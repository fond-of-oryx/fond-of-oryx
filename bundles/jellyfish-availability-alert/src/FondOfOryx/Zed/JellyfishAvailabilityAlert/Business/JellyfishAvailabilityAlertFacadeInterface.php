<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface JellyfishAvailabilityAlertFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return void
     */
    public function dispatchSubscriber(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function dispatchSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
