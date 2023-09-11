<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business;

use FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutor;
use FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutorInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig getConfig()
 */
class PropelPreMigrationBusinessFactory extends AbstractBusinessFactory
{
    use TransactionTrait;

    /**
     * @return \FondOfOryx\Zed\PropelPreMigration\Business\Model\SqlExecutorInterface
     */
    public function createSqlExecutor(): SqlExecutorInterface
    {
        return new SqlExecutor(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->getConfig(),
            $this->getTransactionHandler(),
        );
    }
}
