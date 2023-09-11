<?php

namespace FondOfOryx\Zed\PropelPreMigration;

use FondOfOryx\Shared\PropelPreMigration\PropelPreMigrationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManagerInterface getEntityManager()()
 */
class PropelPreMigrationConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getSqlDirectory(): string
    {
        return rtrim($this->get(PropelPreMigrationConstants::CUSTOM_SQL_DIRECTORY, $this->getDefaultSqlDirectory()), '/') . '/';
    }

    /**
     * @return string
     */
    public function getSqlFilePattern(): string
    {
        return $this->get(PropelPreMigrationConstants::GLOB_SQL_FILE_PATTERN, PropelPreMigrationConstants::GLOB_SQL_FILE_PATTERN_DEFAULT);
    }

    /**
     * @return string
     */
    protected function getDefaultSqlDirectory(): string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'PreMigrations' . DIRECTORY_SEPARATOR; // @phpstan-ignore-line
    }
}
