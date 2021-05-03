<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorPersistenceFactory getFactory()
 */
interface AvailabilityAlertMigratorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return int|null
     */
    public function setMigrated(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): ?int;
}
