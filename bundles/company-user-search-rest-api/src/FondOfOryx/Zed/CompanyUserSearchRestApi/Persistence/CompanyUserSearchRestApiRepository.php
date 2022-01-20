<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiPersistenceFactory getFactory()
 */
class CompanyUserSearchRestApiRepository extends AbstractRepository implements CompanyUserSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        $companyUserQuery = $this->getBaseQuery($companyUserListTransfer);
        $companyUserQuery = $this->addCompanyQuery($companyUserQuery, $companyUserListTransfer);

        $companyUserQuery = $this->addFulltextSearchFields($companyUserQuery, $companyUserListTransfer);
        $companyUserQuery = $this->addSort($companyUserQuery, $companyUserListTransfer);
        $companyUserQuery = $this->preparePagination($companyUserQuery, $companyUserListTransfer);

        $companyUser = $this->getFactory()
            ->createCompanyUserMapper()
            ->mapEntityCollectionToTransfers($companyUserQuery->find());

        return $companyUserListTransfer->setCompanyUser(new ArrayObject($companyUser));
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    protected function getBaseQuery(CompanyUserListTransfer $companyUserListTransfer): SpyCompanyUserQuery
    {
        $query = $this->getFactory()
            ->getCompanyUserQuery()
            ->clear()
            ->innerJoinCustomer()
            ->innerJoinSpyCompanyRoleToCompanyUser()
            ->filterByIsActive(true);

        if ($companyUserListTransfer->getCompanyUserReference() !== null) {
            $query->filterByCompanyUserReference($companyUserListTransfer->getCompanyUserReference());
        }

        if ($companyUserListTransfer->getShowAll() !== true) {
            return $query->filterByFkCustomer($companyUserListTransfer->getCustomerId());
        }

        return $query->where(
            sprintf(
                '%s IN (SELECT %s FROM %s WHERE %s = true AND %s = ?)',
                SpyCompanyUserTableMap::COL_FK_COMPANY,
                SpyCompanyUserTableMap::COL_FK_COMPANY,
                SpyCompanyUserTableMap::TABLE_NAME,
                SpyCompanyUserTableMap::COL_IS_ACTIVE,
                SpyCompanyUserTableMap::COL_FK_CUSTOMER,
            ),
            $companyUserListTransfer->getCustomerId(),
        );
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $companyUserQuery
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    protected function addCompanyQuery(SpyCompanyUserQuery $companyUserQuery, CompanyUserListTransfer $companyUserListTransfer): SpyCompanyUserQuery
    {
        $companyUuid = $companyUserListTransfer->getCompanyUuid();

        if ($companyUuid !== null) {
            return $companyUserQuery
                ->useCompanyQuery()
                ->filterByIsActive(true)
                ->filterByUuid($companyUuid)
                ->endUse();
        }

        return $companyUserQuery
            ->useCompanyQuery()
            ->filterByIsActive(true)
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $companyUserQuery
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    protected function addFulltextSearchFields(
        SpyCompanyUserQuery $companyUserQuery,
        CompanyUserListTransfer $companyUserListTransfer
    ): SpyCompanyUserQuery {
        $query = $companyUserListTransfer->getQuery();

        if ($query === null) {
            return $companyUserQuery;
        }

        $conditionNames = [];
        $tableMap = SpyCompanyUserTableMap::getTableMap();
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
            $companyUserQuery->addCond($conditionName, $columnMap->getFullyQualifiedName(), sprintf('%%%s%%', $query), Criteria::ILIKE);
        }

        if (count($conditionNames) === 0) {
            return $companyUserQuery;
        }

        $companyUserQuery->combine($conditionNames, Criteria::LOGICAL_OR);

        return $companyUserQuery;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $companyUserQuery
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery
     */
    protected function addSort(
        SpyCompanyUserQuery $companyUserQuery,
        CompanyUserListTransfer $companyUserListTransfer
    ): SpyCompanyUserQuery {
        $sort = $companyUserListTransfer->getSort();

        if ($sort === null) {
            return $companyUserQuery;
        }

        $tableMap = SpyCompanyUserTableMap::getTableMap();
        $sortFields = $this->getFactory()->getConfig()->getSortFields();

        [$sortField, $direction] = explode(' ', preg_replace('/(([a-z0-9]+)(_[a-z0-9]+)*)_(asc|desc)/', '$1 $4', $sort));

        if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
            return $companyUserQuery;
        }

        $columnMap = $tableMap->getColumn($sortField);

        $companyUserQuery->orderBy(
            $columnMap->getFullyQualifiedName(),
            $direction === 'desc' ? Criteria::DESC : Criteria::ASC,
        );

        return $companyUserQuery;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $companyUserQuery
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyUserQuery $companyUserQuery,
        CompanyUserListTransfer $companyUserListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $companyUserListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $companyUserQuery->paginate($page, $maxPerPage);

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
