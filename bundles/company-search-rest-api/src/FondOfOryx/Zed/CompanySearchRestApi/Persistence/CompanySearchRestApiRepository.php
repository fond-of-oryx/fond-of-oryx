<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyListTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiPersistenceFactory getFactory()
 */
class CompanySearchRestApiRepository extends AbstractRepository implements CompanySearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        $companyQuery = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->filterByIsActive(true)
            ->useCompanyUserQuery()
                ->useCustomerQuery()
                    ->filterByCustomerReference($companyListTransfer->getCustomerReference())
                ->endUse()
                ->filterByIsActive(true)
            ->endUse();

        $companyQuery = $this->addFulltextSearchFields($companyQuery, $companyListTransfer);
        $companyQuery = $this->addSort($companyQuery, $companyListTransfer);
        $companyQuery = $this->preparePagination($companyQuery, $companyListTransfer);

        $companies = $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityCollectionToTransfers($companyQuery->find());

        return $companyListTransfer->setCompanies(new ArrayObject($companies));
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $companyQuery
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function addFulltextSearchFields(
        SpyCompanyQuery $companyQuery,
        CompanyListTransfer $companyListTransfer
    ): SpyCompanyQuery {
        $query = $companyListTransfer->getQuery();

        if ($query === null) {
            return $companyQuery;
        }

        $conditionNames = [];
        $tableMap = SpyCompanyTableMap::getTableMap();
        $fulltextSearchFields = $this->getFactory()->getConfig()->getFulltextSearchFields();

        foreach ($fulltextSearchFields as $fulltextSearchField) {
            if (!$tableMap->hasColumn($fulltextSearchField)) {
                continue;
            }

            $columnMap = $tableMap->getColumn($fulltextSearchField);

            if (!$columnMap->isText()) {
                continue;
            }

            $conditionNames[] = $conditionName = uniqid($fulltextSearchField, true);
            $companyQuery->addCond($conditionName, $columnMap->getFullyQualifiedName(), sprintf('%%%s%%', $query), Criteria::LIKE);
        }

        if (count($conditionNames) === 0) {
            return $companyQuery;
        }

        $companyQuery->combine($conditionNames, Criteria::LOGICAL_OR);

        return $companyQuery;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $companyQuery
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    protected function addSort(
        SpyCompanyQuery $companyQuery,
        CompanyListTransfer $companyListTransfer
    ): SpyCompanyQuery {
        $sort = $companyListTransfer->getSort();

        if ($sort === null) {
            return $companyQuery;
        }

        $tableMap = SpyCompanyTableMap::getTableMap();
        $sortFields = $this->getFactory()->getConfig()->getSortFields();

        [$sortField, $direction] = explode('_', $sort);

        if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
            return $companyQuery;
        }

        $columnMap = $tableMap->getColumn($sortField);

        $companyQuery->orderBy(
            $columnMap->getFullyQualifiedName(),
            $direction === 'desc' ? Criteria::DESC : Criteria::ASC
        );

        return $companyQuery;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $companyQuery
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyQuery $companyQuery,
        CompanyListTransfer $companyListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $companyListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $companyQuery->paginate($page, $maxPerPage);

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
