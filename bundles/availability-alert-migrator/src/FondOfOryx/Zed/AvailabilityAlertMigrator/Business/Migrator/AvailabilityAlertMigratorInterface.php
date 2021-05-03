<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator;

interface AvailabilityAlertMigratorInterface
{
    /**
     * @return void
     */
    public function migrate(): void;
}
