<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;

interface AvailabilityAlertMigratorExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer;
}
