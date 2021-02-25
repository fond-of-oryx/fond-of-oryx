<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface NotificationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function notify(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
