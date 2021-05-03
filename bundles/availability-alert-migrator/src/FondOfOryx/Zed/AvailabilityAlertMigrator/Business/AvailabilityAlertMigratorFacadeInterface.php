<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business;

interface AvailabilityAlertMigratorFacadeInterface
{
    /**
     * @return void
     */
    public function migrate(): void;
}
