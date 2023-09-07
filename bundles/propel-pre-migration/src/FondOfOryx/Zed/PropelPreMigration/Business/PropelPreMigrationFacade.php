<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationBusinessFactory getFactory()
 */
class PropelPreMigrationFacade extends AbstractFacade implements PropelPreMigrationFacadeInterface
{
    /**
     * @param array $files
     *
     * @return array
     */
    public function execute(array $files): array
    {
        return $this->getFactory()
            ->createSqlExecutor()
            ->execute($files);
    }
}
