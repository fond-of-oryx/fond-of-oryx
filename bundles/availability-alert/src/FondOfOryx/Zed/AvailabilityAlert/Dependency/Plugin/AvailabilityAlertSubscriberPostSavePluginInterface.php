<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriberPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function postSave(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer;
}
