<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Business;

use FondOfOryx\Zed\AvailabilityAlertMigrator\AvailabilityAlertMigratorDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator\AvailabilityAlertMigrator;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator\AvailabilityAlertMigratorInterface;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface getEntityManager()()
 */
class AvailabilityAlertMigratorBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Business\Migrator\AvailabilityAlertMigratorInterface
     */
    public function createAvailabilityAlertMigrator(): AvailabilityAlertMigratorInterface
    {
        return new AvailabilityAlertMigrator(
            $this->getAvailabilityAlertFacade(),
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getLogger()
        );
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface
     */
    protected function getAvailabilityAlertFacade(): AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertMigratorDependencyProvider::FACADE_AVAILABILITY_ALERT);
    }
}
