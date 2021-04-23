<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriptionPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function preSave(AvailabilityAlertSubscriptionTransfer $subscriptionTransfer): AvailabilityAlertSubscriptionTransfer;
}
