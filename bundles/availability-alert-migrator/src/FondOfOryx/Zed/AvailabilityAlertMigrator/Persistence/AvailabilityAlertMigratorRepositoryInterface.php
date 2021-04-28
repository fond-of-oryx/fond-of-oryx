<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

interface AvailabilityAlertMigratorRepositoryInterface
{
    /**
     * @param int $offset
     * @param int|null $limit
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer[]
     */
    public function getAllSubscriptions(int $offset = 0, ?int $limit = null): array;

    /**
     * @return int
     */
    public function getSubscriptionCount(): int;
}
