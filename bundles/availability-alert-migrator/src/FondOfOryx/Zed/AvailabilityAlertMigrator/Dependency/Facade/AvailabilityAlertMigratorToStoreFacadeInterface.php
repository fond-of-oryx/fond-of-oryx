<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface AvailabilityAlertMigratorToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
