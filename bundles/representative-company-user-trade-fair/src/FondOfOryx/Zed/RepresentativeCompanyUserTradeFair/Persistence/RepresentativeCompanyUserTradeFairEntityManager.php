<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence;

use Exception;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairEntityManager extends AbstractEntityManager implements RepresentativeCompanyUserTradeFairEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function createRepresentativeCompanyUserTradeFair(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer
    {
        $entity = $this->getFactory()->createTransferToEntityMapper()->fromRepresentativeCompanyUserTradeFairTransfer($representativeCompanyUserTradeFairTransfer);
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function updateRepresentativeCompanyUserTradeFair(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer
    {
        $representativeCompanyUserTradeFairTransfer->requireUuid();

        $query = new FooRepresentativeCompanyUserTradeFairQuery();
        $entity = $query->filterByUuid($representativeCompanyUserTradeFairTransfer->getUuid())->findOne();

        if ($entity === null) {
            throw new Exception(sprintf('Could not find trade fair with given uuid "%s"', $representativeCompanyUserTradeFairTransfer->getUuid()));
        }

        $entity->fromArray($representativeCompanyUserTradeFairTransfer->modifiedToArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity);
    }

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function deactivate(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        $query = new FooRepresentativeCompanyUserTradeFairQuery();
        $entity = $query->findOneByUuid($uuid);

        if ($entity === null) {
            throw new Exception(sprintf('Could not find trade fair with given uuid "%s"', $uuid));
        }

        $entity->setActive(false);
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity);
    }
}
