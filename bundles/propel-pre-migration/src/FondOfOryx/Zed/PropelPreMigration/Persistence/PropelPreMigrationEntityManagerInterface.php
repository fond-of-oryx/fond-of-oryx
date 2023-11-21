<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence;

use Generated\Shared\Transfer\PropelPreMigrationTransfer;

interface PropelPreMigrationEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PropelPreMigrationTransfer $propelPreMigrationTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \Generated\Shared\Transfer\PropelPreMigrationTransfer
     */
    public function createPropelPreMigrationEntry(PropelPreMigrationTransfer $propelPreMigrationTransfer): PropelPreMigrationTransfer;

    /**
     * @param string $fullFilePath
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function executePlainSqlFromFile(string $fullFilePath): bool;
}
