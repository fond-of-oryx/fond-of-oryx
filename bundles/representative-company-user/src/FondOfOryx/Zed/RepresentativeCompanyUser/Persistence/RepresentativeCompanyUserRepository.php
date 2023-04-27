<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use Exception;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserRepository extends AbstractRepository implements RepresentativeCompanyUserRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findRepresentativeCompanyUserByUuid(string $uuid): RepresentativeCompanyUserTransfer
    {
        $entity = $this->getFactory()->getRepresentativeCompanyUserQuery()->filterByUuid($uuid)->findOne();
        if ($entity === null) {
            throw new Exception(sprintf('Could not find representation of sales by uuid %s', $uuid));
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity);
    }

    /**
     * @param string|null $state
     * @param array|null $ids
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findRepresentativeCompanyUserByState(?string $state, ?array $ids = null): RepresentativeCompanyUserCollectionTransfer
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserQuery();

        if ($state !== null){
            $query->filterByState($state);
        }

        if ($ids !== null) {
            $query->filterByIdRepresentativeCompanyUser_In($ids);
        }

        $result = $query->find();
        $collection = new RepresentativeCompanyUserCollectionTransfer();

        foreach ($result->getData() as $entity){
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|null
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findRepresentativeCompanyUserByCase(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): ?RepresentativeCompanyUserTransfer
    {
        $representativeCompanyUserTransfer
            ->requireFkDistributor()
            ->requireFkRepresentation()
            ->requireStartDate()
            ->requireEndDate();

        $entity = $this->getFactory()->getRepresentativeCompanyUserQuery()
            ->filterByFkDistributor($representativeCompanyUserTransfer->getFkDistributor())
            ->filterByFkDistributor($representativeCompanyUserTransfer->getFkRepresentation())
            ->filterByStartDate($representativeCompanyUserTransfer->getStartDate())
            ->filterByEndDate($representativeCompanyUserTransfer->getEndDate())
            ->findOne();

        if ($entity === null) {
            return null;
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findExpiredRepresentativeCompanyUser(?RepresentativeCompanyUserFilterTransfer $filterTransfer = null): RepresentativeCompanyUserCollectionTransfer
    {
        $query = $this->prepareRepresentativeCompanyUserQuery($filterTransfer);

        $results = $query->where(FooRepresentativeCompanyUserTableMap::COL_END_DATE . '< now()')
            ->find();

        $collection = new RepresentativeCompanyUserCollectionTransfer();

        foreach ($results->getData() as $entity){
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        return $collection;
    }

    /**
     * @param int $fkDistributor
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|null
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findRepresentativeCompanyUserByFkDistributor(int $fkDistributor): ?RepresentativeCompanyUserCollectionTransfer
    {
        $result = $this->getFactory()->getRepresentativeCompanyUserQuery()
            ->filterByFkDistributor($fkDistributor)
            ->find();

        $collection = new RepresentativeCompanyUserCollectionTransfer();
        $data = $result->getData();
        if (count($data) === null) {
            return $collection;
        }

        foreach ($data as $item) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($item));
        }

        return $collection;
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getAllCompanyUserByCustomerId(int $idCustomer): CompanyUserCollectionTransfer
    {
        $collection = new CompanyUserCollectionTransfer();

        $result = $this->getFactory()->getCompanyUserQuery()->findByFkCustomer($idCustomer);

        foreach ($result as $data) {
            $companyUser = (new CompanyUserTransfer())->fromArray($data->toArray(), true);
            if ($data->getFkRepresentativeCompanyUser() !== null){
                $representation = (new RepresentativeCompanyUserTransfer())->fromArray($data->getFooRepresentativeCompanyUser()->toArray(), true);
                $companyUser->setRepresentationOfSale($representation);
            }
            $collection->addCompanyUser($companyUser);
        }

        return $collection;
    }

    /**
     * @param int $idRepresentativeCompanyUser
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function findCompanyUserByIdRepresentativeCompanyUser(int $idRepresentativeCompanyUser): CompanyUserCollectionTransfer
    {
        $collection = new CompanyUserCollectionTransfer();

        $result = $this->getFactory()->getCompanyUserQuery()->findByFkRepresentativeCompanyUser($idRepresentativeCompanyUser);

        foreach ($result as $data) {
            $companyUser = (new CompanyUserTransfer())->fromArray($data->toArray(), true);
            $collection->addCompanyUser($companyUser);
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    protected function prepareRepresentativeCompanyUserQuery(?RepresentativeCompanyUserFilterTransfer $filterTransfer): FooRepresentativeCompanyUserQuery
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserQuery();

        if ($filterTransfer !== null && is_array($filterTransfer->getStates())) {
            $query->filterByState_In($filterTransfer->getStates());
        }

        if ($filterTransfer !== null && is_array($filterTransfer->getIds()) && count($filterTransfer->getIds()) > 0) {
            $query->filterByIdRepresentativeCompanyUser_In($filterTransfer->getIds());
        }
        return $query;
    }
}
