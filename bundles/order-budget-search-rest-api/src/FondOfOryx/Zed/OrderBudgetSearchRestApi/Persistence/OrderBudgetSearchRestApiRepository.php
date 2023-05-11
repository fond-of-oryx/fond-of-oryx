<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence;

use ArrayObject;
use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\Propel\QueryBuilder\OrderBudgetSearchFilterFieldQueryBuilder;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery;
use Orm\Zed\OrderBudget\Persistence\Map\FooOrderBudgetTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiPersistenceFactory getFactory()
 */
class OrderBudgetSearchRestApiRepository extends AbstractRepository implements OrderBudgetSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Generated\Shared\Transfer\OrderBudgetListTransfer
     */
    public function findOrderBudgets(OrderBudgetListTransfer $orderBudgetListTransfer): OrderBudgetListTransfer
    {
        $query = $this->getFactory()
            ->getOrderBudgetQuery()
            ->clear()
            ->groupByIdOrderBudget()
            ->setIgnoreCase(true);

        $query = $this->getFactory()
            ->createOrderBudgetSearchFilterFieldQueryBuilder()
            ->addQueryFilters($query, $orderBudgetListTransfer);

        $queryJoinCollectionTransfer = $orderBudgetListTransfer->getQueryJoins();

        if ($queryJoinCollectionTransfer !== null && $queryJoinCollectionTransfer->getQueryJoins()->count() > 0) {
            $query = $this->getFactory()
                ->createOrderBudgetQueryJoinQueryBuilder()
                ->addQueryFilters($query, $queryJoinCollectionTransfer);
        }

        if ($this->isSearchByAllFilterFieldSet($orderBudgetListTransfer)) {
            $query->where([OrderBudgetSearchFilterFieldQueryBuilder::CONDITION_GROUP_ALL]);
        }

        $ids = $this->preparePagination($query, $orderBudgetListTransfer)
            ->select([FooOrderBudgetTableMap::COL_ID_ORDER_BUDGET])
            ->find()
            ->toArray();

        $orderBudgetTransfers = $this->getFactory()
            ->createOrderBudgetMapper()
            ->fromIds($ids);

        return $orderBudgetListTransfer->setOrderBudgets(new ArrayObject($orderBudgetTransfers));
    }

    /**
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return bool
     */
    protected function isSearchByAllFilterFieldSet(OrderBudgetListTransfer $orderBudgetListTransfer): bool
    {
        foreach ($orderBudgetListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() === OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Orm\Zed\OrderBudget\Persistence\Base\FooOrderBudgetQuery $query
     * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        FooOrderBudgetQuery $query,
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $orderBudgetListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $query->paginate($page, $maxPerPage);

        $paginationTransfer->setNbResults($propelModelPager->getNbResults())
            ->setFirstIndex($propelModelPager->getFirstIndex())
            ->setLastIndex($propelModelPager->getLastIndex())
            ->setFirstPage($propelModelPager->getFirstPage())
            ->setLastPage($propelModelPager->getLastPage())
            ->setNextPage($propelModelPager->getNextPage())
            ->setPreviousPage($propelModelPager->getPreviousPage());

        return $propelModelPager->getQuery();
    }
}
