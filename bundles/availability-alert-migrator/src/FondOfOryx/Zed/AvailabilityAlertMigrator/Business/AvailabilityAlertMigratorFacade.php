<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Business\AvailabilityAlertMigratorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface getRepository()
 */
class AvailabilityAlertMigratorFacade extends AbstractFacade implements AvailabilityAlertMigratorFacadeInterface
{
    /**
     * @return void
     */
    public function migrate(): void
    {
        $this->getFactory()->createAvailabilityAlertMigrator()->migrate();
    }
}
