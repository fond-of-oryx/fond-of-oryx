<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\PropelPreMigrationTransfer;
use Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration;
use Propel\Runtime\Collection\ObjectCollection;

interface PropelPreMigrationMapperInterface
{
    /**
     * @param \Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration $entity
     *
     * @return \Generated\Shared\Transfer\PropelPreMigrationTransfer
     */
    public function fromEntityToTransfer(FooPropelPreMigration $entity): PropelPreMigrationTransfer;

    /**
     * @param \Generated\Shared\Transfer\PropelPreMigrationTransfer $transfer
     *
     * @return \Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration
     */
    public function fromTransferToEntity(PropelPreMigrationTransfer $transfer): FooPropelPreMigration;

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $objectCollection
     *
     * @return array<\Generated\Shared\Transfer\PropelPreMigrationTransfer>
     */
    public function fromObjectCollectionToTransfer(ObjectCollection $objectCollection): array;
}
