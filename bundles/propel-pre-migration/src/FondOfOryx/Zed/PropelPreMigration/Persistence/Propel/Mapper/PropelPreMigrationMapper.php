<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\PropelPreMigrationTransfer;
use Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration;
use Propel\Runtime\Collection\ObjectCollection;

class PropelPreMigrationMapper implements PropelPreMigrationMapperInterface
{
    /**
     * @param \Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration $entity
     *
     * @return \Generated\Shared\Transfer\PropelPreMigrationTransfer
     */
    public function fromEntityToTransfer(FooPropelPreMigration $entity): PropelPreMigrationTransfer
    {
        return (new PropelPreMigrationTransfer())->fromArray($entity->toArray(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\PropelPreMigrationTransfer $transfer
     *
     * @return \Orm\Zed\PropelPreMigration\Persistence\FooPropelPreMigration
     */
    public function fromTransferToEntity(PropelPreMigrationTransfer $transfer): FooPropelPreMigration
    {
        return (new FooPropelPreMigration())->fromArray($transfer->modifiedToArray());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $objectCollection
     *
     * @return array<\Generated\Shared\Transfer\PropelPreMigrationTransfer>
     */
    public function fromObjectCollectionToTransfer(ObjectCollection $objectCollection): array
    {
        $data = [];
        foreach ($objectCollection->getData() as $entity) {
            $data[] = $this->fromEntityToTransfer($entity);
        }

        return $data;
    }
}
