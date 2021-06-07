<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param bool $preferFromTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        bool $preferFromTransfer = false
    ): AvailabilityAlertSubscriptionResponseTransfer;
}
