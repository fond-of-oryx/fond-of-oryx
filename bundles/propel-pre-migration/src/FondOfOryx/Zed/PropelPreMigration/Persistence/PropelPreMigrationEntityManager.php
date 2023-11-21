<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence;

use Exception;
use Generated\Shared\Transfer\PropelPreMigrationTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationPersistenceFactory getFactory()
 */
class PropelPreMigrationEntityManager extends AbstractEntityManager implements PropelPreMigrationEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PropelPreMigrationTransfer $propelPreMigrationTransfer
     *
     * @return \Generated\Shared\Transfer\PropelPreMigrationTransfer
     */
    public function createPropelPreMigrationEntry(PropelPreMigrationTransfer $propelPreMigrationTransfer): PropelPreMigrationTransfer
    {
        $entity = $this->getFactory()->createPropelPreMigrationMapper()->fromTransferToEntity($propelPreMigrationTransfer);
        $entity->save();

        return $this->getFactory()->createPropelPreMigrationMapper()->fromEntityToTransfer($entity);
    }

    /**
     * @param string $fullFilePath
     *
     * @return bool
     */
    public function executePlainSqlFromFile(string $fullFilePath): bool
    {
        $stmt = $this->getFactory()->getPropelConnection()->prepare($this->getSqlDataFromFile($fullFilePath));

        return $stmt->execute();
    }

    /**
     * @param string $fullFilePath
     *
     * @throws \Exception
     *
     * @return string
     */
    protected function getSqlDataFromFile(string $fullFilePath): string
    {
        $content = false;
        if (file_exists($fullFilePath)) {
            $content = file_get_contents($fullFilePath);
        }

        if ($content !== false) {
            return $content;
        }

        throw new Exception(sprintf('Could not read file "%s"', $fullFilePath));
    }
}
