<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriptionPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function postSave(AvailabilityAlertSubscriptionTransfer $subscriptionTransfer): AvailabilityAlertSubscriptionTransfer;
}
