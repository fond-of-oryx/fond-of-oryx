<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiPersistenceFactory getFactory()
 */
class ProductListSearchRestApiRepository extends AbstractRepository implements ProductListSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        $productListQuery = $this->getBaseQuery();

        $productListQuery = $this->getFactory()
            ->createProductListSearchFilterFieldQueryBuilder()
            ->addQueryFilters($productListQuery, $productListCollectionTransfer);

        $queryJoinCollectionTransfer = $productListCollectionTransfer->getQueryJoins();

        if ($queryJoinCollectionTransfer !== null && $queryJoinCollectionTransfer->getQueryJoins()->count() > 0) {
            $productListQuery = $this->getFactory()
                ->createQuoteQueryJoinQueryBuilder()
                ->addQueryFilters($productListQuery, $queryJoinCollectionTransfer);
        }

        $productListQuery = $this->addSort($productListQuery, $productListCollectionTransfer);
        $productListQuery = $this->preparePagination($productListQuery, $productListCollectionTransfer);

        $productListCollection = $this->getFactory()
            ->createProductListMapper()
            ->mapEntityCollectionToTransfers($productListQuery->find());

        return $productListCollectionTransfer->setProductLists(new ArrayObject($productListCollection));
    }

    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function getBaseQuery(): SpyProductListQuery
    {
        return $this->getFactory()->getProductListQuery();
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addFulltextSearchFields(
        SpyProductListQuery $productListQuery,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): SpyProductListQuery {
        $query = $productListCollectionTransfer->getQuery();

        if ($query === null) {
            return $productListQuery;
        }

        $fulltextSearchFields = $this->getFactory()->getConfig()->getFulltextSearchFields();
        $conditionNames = [];
        $tableMaps = [
            SpyProductListTableMap::getTableMap(),
        ];

        foreach ($fulltextSearchFields as $fulltextSearchField) {
            foreach ($tableMaps as $tableMap) {
                if (!$tableMap->hasColumn($fulltextSearchField)) {
                    continue;
                }

                $columnMap = $tableMap->getColumn($fulltextSearchField);

                if (!$columnMap->isText()) {
                    continue;
                }

                $conditionNames[] = $conditionName = uniqid($fulltextSearchField, true);
                $productListQuery->addCond(
                    $conditionName,
                    $columnMap->getFullyQualifiedName(),
                    sprintf('%%%s%%', $query),
                    Criteria::ILIKE,
                );

                break;
            }
        }

        if (count($conditionNames) === 0) {
            return $productListQuery;
        }

        $productListQuery->combine($conditionNames, Criteria::LOGICAL_OR);

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    protected function addSort(
        SpyProductListQuery $productListQuery,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): SpyProductListQuery {
        $sort = $productListCollectionTransfer->getSort();

        if ($sort === null) {
            return $productListQuery;
        }

        $sortFields = $this->getFactory()->getConfig()->getSortFields();
        $tableMaps = [
            SpyProductListTableMap::getTableMap(),
            SpyProductListTableMap::getTableMap(),
        ];

        [$sortField, $direction] = explode(' ', preg_replace('/(([a-z0-9]+)(_[a-z0-9]+)*)_(asc|desc)/', '$1 $4', $sort));

        foreach ($tableMaps as $tableMap) {
            if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
                continue;
            }

            $columnMap = $tableMap->getColumn($sortField);

            return $productListQuery->orderBy(
                $columnMap->getFullyQualifiedName(),
                $direction === 'desc' ? Criteria::DESC : Criteria::ASC,
            );
        }

        return $productListQuery;
    }

    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyProductListQuery $productListQuery,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $productListCollectionTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $productListQuery->paginate($page, $maxPerPage);

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
