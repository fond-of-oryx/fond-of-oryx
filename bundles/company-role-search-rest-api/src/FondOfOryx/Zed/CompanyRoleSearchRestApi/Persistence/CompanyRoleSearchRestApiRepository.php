<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiPersistenceFactory getFactory()
 */
class CompanyRoleSearchRestApiRepository extends AbstractRepository implements CompanyRoleSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer
    {
        $companyIds = [];
        if ($companyRoleListTransfer->getShowAll() === true) {
            $query = $this->getBaseQuery($companyRoleListTransfer);
            $companyIds = $query->select(str_replace(sprintf('%s.', SpyCompanyRoleTableMap::TABLE_NAME), '', SpyCompanyRoleTableMap::COL_FK_COMPANY))->find()->getData();
        }

        $companyRoleQuery = $this->getBaseQuery($companyRoleListTransfer, $companyIds);
        $companyRoleQuery = $this->addCompanyQuery($companyRoleQuery, $companyRoleListTransfer);

        $companyRoleQuery = $this->addFulltextSearchFields($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->addSort($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->preparePagination($companyRoleQuery, $companyRoleListTransfer);

        $companyRole = $this->getFactory()
            ->createCompanyRoleMapper()
            ->mapEntityCollectionToTransfers($companyRoleQuery->find());

        return $companyRoleListTransfer->setCompanyRole(new ArrayObject($companyRole));
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     * @param array $companyIds
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function getBaseQuery(
        CompanyRoleListTransfer $companyRoleListTransfer,
        array $companyIds = []
    ): SpyCompanyRoleQuery {
        $query = $this->getFactory()
            ->getCompanyRoleQuery()
            ->clear();

        if (count($companyIds) > 0) {
            return $query->filterByFkCompany_In($companyIds);
        }

        return $query;
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addCompanyQuery(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $companyUuid = $companyRoleListTransfer->getCompanyUuid();
        if ($companyUuid !== null) {
            return $companyRoleQuery
                ->useCompanyQuery()
                ->filterByUuid($companyUuid)
                ->endUse();
        }

        return $companyRoleQuery
            ->useCompanyQuery()
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addFulltextSearchFields(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $query = $companyRoleListTransfer->getQuery();

        if ($query === null) {
            return $companyRoleQuery;
        }

        $conditionNames = [];
        $tableMap = SpyCompanyRoleTableMap::getTableMap();
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
            $companyRoleQuery->addCond($conditionName, $columnMap->getFullyQualifiedName(), sprintf('%%%s%%', $query), Criteria::ILIKE);
        }

        if (count($conditionNames) === 0) {
            return $companyRoleQuery;
        }

        $companyRoleQuery->combine($conditionNames, Criteria::LOGICAL_OR);

        return $companyRoleQuery;
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addSort(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $sort = $companyRoleListTransfer->getSort();

        if ($sort === null) {
            return $companyRoleQuery;
        }

        $tableMap = SpyCompanyRoleTableMap::getTableMap();
        $sortFields = $this->getFactory()->getConfig()->getSortFields();

        [$sortField, $direction] = explode('_', $sort);

        if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
            return $companyRoleQuery;
        }

        $columnMap = $tableMap->getColumn($sortField);

        $companyRoleQuery->orderBy(
            $columnMap->getFullyQualifiedName(),
            $direction === 'desc' ? Criteria::DESC : Criteria::ASC,
        );

        return $companyRoleQuery;
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $companyRoleListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $companyRoleQuery->paginate($page, $maxPerPage);

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
