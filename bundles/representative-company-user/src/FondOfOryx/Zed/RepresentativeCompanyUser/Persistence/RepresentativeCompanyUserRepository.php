<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserRepository extends AbstractRepository implements RepresentativeCompanyUserRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
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
     */
    public function findRepresentativeCompanyUserByState(?string $state, ?array $ids = null): RepresentativeCompanyUserCollectionTransfer
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserQuery();

        if ($state !== null) {
            $query->filterByState($state);
        }

        if ($ids !== null) {
            $query->filterByIdRepresentativeCompanyUser_In($ids);
        }

        $result = $query->find();
        $collection = new RepresentativeCompanyUserCollectionTransfer();

        foreach ($result->getData() as $entity) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|null
     */
    public function findRepresentativeCompanyUserByCase(
        RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
    ): ?RepresentativeCompanyUserTransfer {
        $representativeCompanyUserTransfer
            ->requireFkDistributor()
            ->requireFkRepresentative()
            ->requireStartAt()
            ->requireEndAt();

        $entity = $this->getFactory()->getRepresentativeCompanyUserQuery()
            ->filterByFkDistributor($representativeCompanyUserTransfer->getFkDistributor())
            ->filterByFkDistributor($representativeCompanyUserTransfer->getFkRepresentative())
            ->filterByStartAt($representativeCompanyUserTransfer->getStartAt())
            ->filterByEndAt($representativeCompanyUserTransfer->getEndAt())
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
     */
    public function findExpiredRepresentativeCompanyUser(
        ?RepresentativeCompanyUserFilterTransfer $filterTransfer = null
    ): RepresentativeCompanyUserCollectionTransfer {
        $query = $this->prepareRepresentativeCompanyUserQuery($filterTransfer);

        $expireAt = $this->getFactory()->getUtilDateTimeService()->formatDateTime(new DateTime());
        $results = $query->filterByEndAt($expireAt, Criteria::LESS_THAN)->find();

        $collection = new RepresentativeCompanyUserCollectionTransfer();

        foreach ($results->getData() as $entity) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getRepresentativeCompanyUser(
        ?RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer {
        $query = $this->prepareRepresentativeCompanyUserQuery($filterTransfer);

        $maxItems = $query->count();

        if ($filterTransfer->getLimit() !== null) {
            $query->setLimit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset() !== null) {
            $query->setOffset($filterTransfer->getOffset());
        }

        $results = $query->find();

        $collection = new RepresentativeCompanyUserCollectionTransfer();

        foreach ($results->getData() as $entity) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($entity));
        }

        $paginationTransfer = (new PaginationTransfer())
            ->setOffset($filterTransfer->getOffset())
            ->setLimit($filterTransfer->getLimit())
            ->setTotal($maxItems);

        return $collection->setPagination($paginationTransfer);
    }

    /**
     * @param int $fkDistributor
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|null
     */
    public function findRepresentativeCompanyUserByFkDistributor(int $fkDistributor): ?RepresentativeCompanyUserCollectionTransfer
    {
        $result = $this->getFactory()->getRepresentativeCompanyUserQuery()
            ->filterByFkDistributor($fkDistributor)
            ->find();

        $collection = new RepresentativeCompanyUserCollectionTransfer();
        $data = $result->getData();
        if (count($data) === 0) {
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
            if ($data->getFkRepresentativeCompanyUser() !== null) {
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
     * @param string $uuid
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findRepresentationByUuid(string $uuid): RepresentativeCompanyUserTransfer
    {
        $result = $this->getFactory()->getRepresentativeCompanyUserQuery()->findOneByUuid($uuid);

        if ($result === null) {
            throw new Exception(sprintf('Could not find representative company user entry with given uuid "%s"', $uuid));
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserEntity($result);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    protected function prepareRepresentativeCompanyUserQuery(?RepresentativeCompanyUserFilterTransfer $filterTransfer): FooRepresentativeCompanyUserQuery
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserQuery();

        if ($filterTransfer !== null && count($filterTransfer->getStates()) > 0) {
            $query->filterByState_In($filterTransfer->getStates());
        }

        if ($filterTransfer !== null && count($filterTransfer->getIds()) > 0) {
            $query->filterByIdRepresentativeCompanyUser_In($filterTransfer->getIds());
        }

        if (count($filterTransfer->getDistributorReferences()) > 0) {
            $query
                ->useFooRepresentativeCompanyUserDistributorQuery()
                    ->filterByEmail_In($filterTransfer->getDistributorReferences())
                ->endUse();
        }

        if ($filterTransfer !== null && $filterTransfer->getSorting()->count() > 0) {
            foreach ($filterTransfer->getSorting() as $sort) {
                $field = str_replace('-', '', ucwords($sort->getField(), '-'));
                if (in_array($field, FooRepresentativeCompanyUserTableMap::getFieldNames(), true)) {
                    $query->orderBy($field, $sort->getDirection());
                }
            }
        }

        return $this->expandFooRepresentativeCompanyUserQuery($query, $filterTransfer);
    }

    /**
     * @param \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery
     */
    protected function expandFooRepresentativeCompanyUserQuery(
        FooRepresentativeCompanyUserQuery $query,
        ?RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): FooRepresentativeCompanyUserQuery {
        if ($filterTransfer !== null) {
            foreach ($this->getFactory()->getFooRepresentativeCompanyUserQueryExpanderPlugins() as $plugin) {
                $query = $plugin->expand($query, $filterTransfer);
            }
        }

        return $query;
    }
}
