<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserEntityManager extends AbstractEntityManager implements RepresentativeCompanyUserEntityManagerInterface
{
    /**
     * @return string
     */
    public function getInProcessState(): string
    {
        return FooRepresentativeCompanyUserTableMap::COL_STATE_PROCESS;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function createRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        $entity = $this->getFactory()->createTransferToEntityMapper()->fromRepresentativeCompanyUserTransfer($representativeCompanyUserTransfer);
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        $representativeCompanyUserTransfer->requireUuid();

        $query = new FooRepresentativeCompanyUserQuery();
        $entity = $query->filterByUuid($representativeCompanyUserTransfer->getUuid())->findOne();

        if ($entity === null) {
            throw new Exception(sprintf('Could not find representation with given uuid "%s"', $representativeCompanyUserTransfer->getUuid()));
        }

        if ($entity->getState() === FooRepresentativeCompanyUserTableMap::COL_STATE_PROCESS) {
            throw new Exception(sprintf('Representation with given uuid "%s" is still in process, please try again later!', $representativeCompanyUserTransfer->getUuid()));
        }
        $entity->fromArray($representativeCompanyUserTransfer->modifiedToArray());
        $entity->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity);
    }

    /**
     * @param string $uuid
     * @param string $state
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function flagState(string $uuid, string $state): RepresentativeCompanyUserTransfer
    {
        $this->validateState($state);
        $entity = $this->getFactory()->getRepresentativeCompanyUserQuery()->findOneByUuid($uuid);

        if ($entity === null) {
            throw new Exception(sprintf('Could not find representation of sales by uuid "%s"', $uuid));
        }

        $oldState = $entity->getState();

        $entity
            ->setPreviousState($oldState)
            ->setState($state)
            ->setUpdatedAt(time())
            ->save();

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findAndFlagInProcessNewRepresentativeCompanyUser(
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        return $this->findAndFlagRepresentativeCompanyUserByState(FooRepresentativeCompanyUserTableMap::COL_STATE_NEW, FooRepresentativeCompanyUserTableMap::COL_STATE_PROCESS, $filterTransfer);
    }

    /**
     * @param string $state
     * @param string $newState
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findAndFlagRepresentativeCompanyUserByState(
        string $state,
        string $newState,
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        $this->validateState($newState);
        $this->validateState($state);

        $query = $this->getFactory()->getRepresentativeCompanyUserQuery()->filterByState($state);
        $ids = $filterTransfer->getIds();
        if (count($ids) > 0) {
            $query->filterByIdRepresentativeCompanyUser_In($ids);
        }

        if ($filterTransfer->getValidTimeRange()) {
            $now = $this->getFactory()->getUtilDateTimeService()->formatDateTime(new DateTime());
            $query
                ->filterByStartAt($now, Criteria::LESS_EQUAL)
                ->filterByEndAt($now, Criteria::GREATER_EQUAL);
        }

        $result = $query->find();
        $collection = new RepresentativeCompanyUserCollectionTransfer();

        /** @var \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUser $entity */
        foreach ($result->getData() as $entity) {
            $entity
                ->setUpdatedAt(time())
                ->setState($newState)
                ->setPreviousState($state)
                ->save();
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        return $collection;
    }

    /**
     * @param string $state
     *
     * @throws \Exception
     *
     * @return bool
     */
    protected function validateState(string $state): bool
    {
        $states = FooRepresentativeCompanyUserTableMap::getValueSet(FooRepresentativeCompanyUserTableMap::COL_STATE);
        $resolvedState = array_search($state, $states);

        if ($resolvedState !== false) {
            return true;
        }

        throw new Exception(sprintf('Could not resolve state "%s". Please use one of the following states "%s" instead', $state, implode(', ', $states)));
    }
}
