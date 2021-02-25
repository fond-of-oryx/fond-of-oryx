<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriptionTransferExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
    ): AvailabilityAlertSubscriptionTransfer;
}
