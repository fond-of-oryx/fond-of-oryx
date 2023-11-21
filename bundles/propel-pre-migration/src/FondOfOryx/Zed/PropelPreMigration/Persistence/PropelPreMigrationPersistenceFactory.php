<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence;

use FondOfOryx\Zed\PropelPreMigration\Persistence\Propel\Mapper\PropelPreMigrationMapper;
use FondOfOryx\Zed\PropelPreMigration\Persistence\Propel\Mapper\PropelPreMigrationMapperInterface;
use FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationDependencyProvider;
use Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigrationQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class PropelPreMigrationPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\PropelPreMigration\Persistence\Propel\Mapper\PropelPreMigrationMapperInterface
     */
    public function createPropelPreMigrationMapper(): PropelPreMigrationMapperInterface
    {
        return new PropelPreMigrationMapper();
    }

    /**
     * @return \Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigrationQuery
     */
    public function getFooPropelPreMigrationQuery(): FooPropelPreMigrationQuery
    {
        return FooPropelPreMigrationQuery::create()->clear();
    }

    /**
     * @return \Propel\Runtime\Connection\ConnectionInterface
     */
    public function getPropelConnection(): ConnectionInterface
    {
        return $this->getProvidedDependency(PropelPreMigrationDependencyProvider::PROPEL_CONNECTION);
    }
}
