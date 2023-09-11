<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationPersistenceFactory getFactory()
 */
class PropelPreMigrationRepository extends AbstractRepository implements PropelPreMigrationRepositoryInterface
{
    /**
     * @param array<string> $sqlFileNames
     *
     * @return array<\Generated\Shared\Transfer\PropelPreMigrationTransfer>
     */
    public function findPreMigrationsByFileNames(array $sqlFileNames): array
    {
        /** @var \Propel\Runtime\Collection\ObjectCollection $result */
        $result = $this->getFactory()->getFooPropelPreMigrationQuery()->filterByFile_In($sqlFileNames)->find();

        return $this->getFactory()->createPropelPreMigrationMapper()->fromObjectCollectionToTransfer($result);
    }

    /**
     * @param array<string> $sqlFileNames
     *
     * @return array<string>
     */
    public function getNotMigratedFileNamesByFileNames(array $sqlFileNames): array
    {
        $migrated = $this->findPreMigrationsByFileNames($sqlFileNames);
        $alreadyMigrated = [];
        foreach ($migrated as $transfer) {
            $alreadyMigrated[] = $transfer->getFile();
        }

        return array_diff($sqlFileNames, $alreadyMigrated);
    }
}
