<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer;

interface AvailabilityAlertMigratorRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return array<\Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer>
     */
    public function getAllSubscriptions(AvailabilityAlertMigratorFilterTransfer $filterTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertMigratorFilterTransfer $filterTransfer
     *
     * @return int
     */
    public function getSubscriptionCount(AvailabilityAlertMigratorFilterTransfer $filterTransfer): int;
}
