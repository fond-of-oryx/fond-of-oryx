<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence;

use Exception;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery;
use Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\Map\FooRepresentativeCompanyUserTradeFairTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRepository extends AbstractRepository implements RepresentativeCompanyUserTradeFairRepositoryInterface
{
    /**
     * @var array
     */
    protected const MARKER_EXPIRED = [
        FooRepresentativeCompanyUserTableMap::COL_STATE_EXPIRED,
        FooRepresentativeCompanyUserTableMap::COL_STATE_REVOKED,
        FooRepresentativeCompanyUserTableMap::COL_STATE_ERROR,
    ];

    /**
     * @param string $uuid
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findRepresentativeCompanyUserTradeFairByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        $entity = $this->prepareQuery()->filterByUuid($uuid)->findOne();
        if ($entity === null) {
            throw new Exception(sprintf('Could not find trade fair by uuid %s', $uuid));
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer|null $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function findExpiredRepresentativeCompanyUserTradeFair(
        ?RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer = null
    ): RepresentativeCompanyUserTradeFairCollectionTransfer {
        $query = $this->prepareQuery($filterTransfer);

        $results = $query->where(FooRepresentativeCompanyUserTradeFairTableMap::COL_END_AT . '< now()')
            ->find();

        $collection = new RepresentativeCompanyUserTradeFairCollectionTransfer();

        foreach ($results->getData() as $entity) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity));
        }

        return $collection;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer {
        $query = $this->prepareQuery($filterTransfer);

        $maxItems = $query->count();

        if ($filterTransfer->getLimit() !== null) {
            $query->setLimit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset() !== null) {
            $query->setOffset($filterTransfer->getOffset());
        }

        $results = $query->find();

        $collection = new RepresentativeCompanyUserTradeFairCollectionTransfer();

        foreach ($results->getData() as $entity) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($entity));
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
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer|null
     */
    public function findRepresentativeCompanyUserTradeFairByFkDistributor(int $fkDistributor): ?RepresentativeCompanyUserTradeFairCollectionTransfer
    {
        $result = $this->prepareQuery()
            ->filterByFkDistributor($fkDistributor)
            ->find();

        $collection = new RepresentativeCompanyUserTradeFairCollectionTransfer();
        $data = $result->getData();
        if (count($data) === 0) {
            return $collection;
        }

        foreach ($data as $item) {
            $collection->addRepresentation($this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($item));
        }

        return $collection;
    }

    /**
     * @param int $fkRepresentativeCompanyUserTradeFair
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findRepresentativeCompanyUserByFkTradeFair(int $fkRepresentativeCompanyUserTradeFair): RepresentativeCompanyUserCollectionTransfer
    {
        $result = $this->getFactory()->getRepresentativeCompanyUserQuery()
            ->filterByFkRepresentativeCompanyUserTradeFair($fkRepresentativeCompanyUserTradeFair)
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
     * @param string $uuid
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer
    {
        $result = $this->prepareQuery()->findOneByUuid($uuid);

        if ($result === null) {
            throw new Exception(sprintf('Could not find trade fair entry with given uuid "%s"', $uuid));
        }

        return $this->getFactory()->createEntityToTransferMapper()->fromRepresentativeCompanyUserTradeFairEntity($result);
    }

    /**
     * @param int $fkRepresentative
     *
     * @return array
     */
    public function resolveDistributorFksToRepresent(int $fkRepresentative): array
    {
        return $this->getFactory()->getCustomerQuery()
                ->useCompanyUserQuery()
                    ->useSpyCompanyRoleToCompanyUserQuery()
                        ->useCompanyRoleQuery()
                            ->filterByName('distribution')
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->select(SpyCustomerTableMap::COL_ID_CUSTOMER)
                ->where(SpyCustomerTableMap::COL_ID_CUSTOMER . ' != ?', $fkRepresentative)
                ->groupBy(SpyCustomerTableMap::COL_ID_CUSTOMER)
                ->find()
                ->getData();
    }

    /**
     * @return array
     */
    public function getUuidsOfExpiredTradeFairs(): array
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserTradeFairQuery()
            ->joinFooRepresentativeCompanyUser()
            ->select(FooRepresentativeCompanyUserTradeFairTableMap::COL_UUID)
            ->where(FooRepresentativeCompanyUserTradeFairTableMap::COL_END_AT . ' < now()')
            ->addAnd(FooRepresentativeCompanyUserTradeFairTableMap::COL_ACTIVE, true, Criteria::EQUAL)
            ->addAnd(FooRepresentativeCompanyUserTableMap::COL_STATE, $this->getExpiredCheckValues(), Criteria::IN)
            ->groupBy(FooRepresentativeCompanyUserTradeFairTableMap::COL_UUID);

        return $query->find()
            ->getData();
    }

    /**
     * @return array<int>
     */
    protected function getExpiredCheckValues(): array
    {
        $values = FooRepresentativeCompanyUserTableMap::getValueSet(FooRepresentativeCompanyUserTableMap::COL_STATE);

        return array_intersect_key(
            array_flip($values),
            array_flip(self::MARKER_EXPIRED),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery
     */
    protected function prepareQuery(?RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer = null): FooRepresentativeCompanyUserTradeFairQuery
    {
        $query = $this->getFactory()->getRepresentativeCompanyUserTradeFairQuery();

        if ($filterTransfer === null) {
            return $query;
        }

        if ($filterTransfer->getTradeFairName() !== null) {
            $query->filterByName($filterTransfer->getTradeFairName());
        }

        if ($filterTransfer->getActive() !== null) {
            $query->filterByActive($filterTransfer->getActive());
        }

        if (count($filterTransfer->getUuids()) > 0) {
            $query->filterByUuid_In($filterTransfer->getUuids());
        }

        if (count($filterTransfer->getFkDistributors()) > 0) {
            $query->filterByFkDistributor_In($filterTransfer->getFkDistributors());
        }

        if ($filterTransfer->getRepresentative() !== null) {
            $query
                ->useFooRepresentativeCompanyUserTradeFairDistributorQuery()
                    ->filterByCustomerReference($filterTransfer->getRepresentative())
                ->endUse();
        }

        if ($filterTransfer->getSorting()->count() > 0) {
            foreach ($filterTransfer->getSorting() as $sort) {
                $field = str_replace('-', '', ucwords($sort->getField(), '-'));
                if (in_array($field, FooRepresentativeCompanyUserTradeFairTableMap::getFieldNames(), true)) {
                    $query->orderBy($field, $sort->getDirection());
                }
            }
        }

        return $this->expandFooRepresentativeCompanyUserTradeFairQuery($query, $filterTransfer);
    }

    /**
     * @param \Orm\Zed\RepresentativeCompanyUserTradeFair\Persistence\FooRepresentativeCompanyUserTradeFairQuery $query
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer|null $filterTransfer
     *
     * @return mixed
     */
    protected function expandFooRepresentativeCompanyUserTradeFairQuery(
        FooRepresentativeCompanyUserTradeFairQuery $query,
        ?RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): mixed {
        if ($filterTransfer !== null) {
            foreach ($this->getFactory()->getFooRepresentativeCompanyUserTradeFairQueryExpanderPlugins() as $plugin) {
                $query = $plugin->expand($query, $filterTransfer);
            }
        }

        return $query;
    }
}
