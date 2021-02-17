<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscriptionManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function isAlreadySubscribed(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    );

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    );
}
