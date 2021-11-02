<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use FondOfOryx\Zed\AvailabilityAlertMigrator\AvailabilityAlertMigratorDependencyProvider;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToStoreFacadeInterface;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\AvailabilityAlertMigrationDataMapper;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\AvailabilityAlertMigrationDataMapperInterface;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\Expander;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorEntityManagerInterface getEntityManager()
 */
class AvailabilityAlertMigratorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscriptionQuery
     */
    public function createFosAvailabilityAlertSubscriptionQuery(): FosAvailabilityAlertSubscriptionQuery
    {
        return FosAvailabilityAlertSubscriptionQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\AvailabilityAlertMigrationDataMapperInterface
     */
    public function createAvailabilityAlertMigrationDataMapper(): AvailabilityAlertMigrationDataMapperInterface
    {
        return new AvailabilityAlertMigrationDataMapper($this->createExpander());
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade\AvailabilityAlertMigratorToStoreFacadeInterface
     */
    public function getStoreFacade(): AvailabilityAlertMigratorToStoreFacadeInterface
    {
        return $this->getProvidedDependency(AvailabilityAlertMigratorDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface
     */
    protected function createExpander(): ExpanderInterface
    {
        return new Expander($this->getExpanderPlugins());
    }

    /**
     * @return array<\FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface>
     */
    protected function getExpanderPlugins(): array
    {
        return $this->getProvidedDependency(AvailabilityAlertMigratorDependencyProvider::PLUGINS_AVAILABILITY_ALERT_MIGRATOR_EXPANDER);
    }
}
