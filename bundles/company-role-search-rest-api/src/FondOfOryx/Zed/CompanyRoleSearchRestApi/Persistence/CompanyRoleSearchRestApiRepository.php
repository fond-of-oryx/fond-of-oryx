<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToCompanyUserTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToPermissionTableMap;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Permission\Persistence\Map\SpyPermissionTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiPersistenceFactory getFactory()
 */
class CompanyRoleSearchRestApiRepository extends AbstractRepository implements CompanyRoleSearchRestApiRepositoryInterface
{
    /**
     * @var string
     */
    protected const COL_FIRST_COMPANY_ROLE_ID = 'firstCompanyRoleId';

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer
    {
        $companyRoleQuery = $this->getFactory()
            ->getCompanyRoleQuery()
            ->clear();

        $companyRoleQuery = $this->addShowAllFilter($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->addOnlyOnePerNameFilter($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->addFulltextSearchFields($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->addSort($companyRoleQuery, $companyRoleListTransfer);
        $companyRoleQuery = $this->preparePagination($companyRoleQuery, $companyRoleListTransfer);

        $companyRole = $this->getFactory()
            ->createCompanyRoleMapper()
            ->mapEntityCollectionToTransfers($companyRoleQuery->find());

        return $companyRoleListTransfer->setCompanyRole(new ArrayObject($companyRole));
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addShowAllFilter(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        if ($companyRoleListTransfer->getShowAll() === false) {
            return $this->addAssignedFilter($companyRoleQuery, $companyRoleListTransfer);
        }

        $companyRoleQuery = $this->addAssignableFilter($companyRoleQuery, $companyRoleListTransfer);

        return $this->addWhitelistFilter($companyRoleQuery, $companyRoleListTransfer);
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addAssignedFilter(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $companyUuid = $companyRoleListTransfer->getCompanyUuid();

        if ($companyUuid !== null) {
            return $companyRoleQuery
                ->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyUserQuery()
                        ->useCompanyQuery()
                            ->filterByUuid($companyUuid)
                            ->filterByIsActive(true)
                        ->endUse()
                        ->filterByFkCustomer($companyRoleListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                ->endUse();
        }

        return $companyRoleQuery
            ->useSpyCompanyRoleToCompanyUserQuery()
                ->useCompanyUserQuery()
                    ->useCompanyQuery()
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByFkCustomer($companyRoleListTransfer->getCustomerId())
                    ->filterByIsActive(true)
                ->endUse()
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addAssignableFilter(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $companyUuid = $companyRoleListTransfer->getCompanyUuid();

        if ($companyUuid !== null) {
            return $companyRoleQuery
                ->useCompanyQuery()
                    ->useCompanyUserQuery()
                        ->filterByFkCustomer($companyRoleListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByUuid($companyUuid)
                    ->filterByIsActive(true)
                ->endUse();
        }

        return $companyRoleQuery
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->filterByFkCustomer($companyRoleListTransfer->getCustomerId())
                    ->filterByIsActive(true)
                ->endUse()
                ->filterByIsActive(true)
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addWhitelistFilter(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        $config = $this->getFactory()->getConfig();

        if (!$config->useWhitelistPermissions()) {
            return $companyRoleQuery;
        }

        return $companyRoleQuery->where(
            sprintf(
                <<<EOD
                %s IN (
                    SELECT temp.id_company_role FROM (
                        SELECT *, CONCAT(%s, '-', %s) AS whitelist_key FROM %s
                    ) AS temp WHERE temp.whitelist_key IN (
                        SELECT CONCAT(
                            REGEXP_REPLACE(
                                LOWER(
                                    REGEXP_REPLACE(%s, '([A-Z])', '_\\1', 'g')
                                ),
                                '_%s_(([a-z]+)(_[a-z]+)*)_%s',
                                '\\1',
                                'g'
                            ),
                            '-',
                            %s
                        ) FROM %s
                            INNER JOIN %s ON %s = %s
                            INNER JOIN %s ON %s = %s
                            INNER JOIN %s ON %s = %s WHERE %s = ? AND %s LIKE '%s%%%s'
                    )
                )
                EOD,
                SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE,
                SpyCompanyRoleTableMap::COL_NAME,
                SpyCompanyRoleTableMap::COL_FK_COMPANY,
                SpyCompanyRoleTableMap::TABLE_NAME,
                SpyPermissionTableMap::COL_KEY,
                $config->getSnakeCasedWhitelistPermissionPrefix(),
                $config->getSnakeCasedWhitelistPermissionSuffix(),
                SpyCompanyUserTableMap::COL_FK_COMPANY,
                SpyCompanyRoleToPermissionTableMap::TABLE_NAME,
                SpyCompanyRoleToCompanyUserTableMap::TABLE_NAME,
                SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE,
                SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE,
                SpyCompanyUserTableMap::TABLE_NAME,
                SpyCompanyUserTableMap::COL_ID_COMPANY_USER,
                SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER,
                SpyPermissionTableMap::TABLE_NAME,
                SpyPermissionTableMap::COL_ID_PERMISSION,
                SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION,
                SpyCompanyUserTableMap::COL_FK_CUSTOMER,
                SpyPermissionTableMap::COL_KEY,
                $config->getPascalCasedWhitelistPermissionPrefix(),
                $config->getPascalCasedWhitelistPermissionSuffix(),
            ),
            $companyRoleListTransfer->getCustomerId(),
        );
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

    /**
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery $companyRoleQuery
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected function addOnlyOnePerNameFilter(
        SpyCompanyRoleQuery $companyRoleQuery,
        CompanyRoleListTransfer $companyRoleListTransfer
    ): SpyCompanyRoleQuery {
        if ($companyRoleListTransfer->getOnlyOnePerName() === false) {
            return $companyRoleQuery;
        }

        $clonedCompanyRoleQuery = clone $companyRoleQuery;

        $companyRoleIds = $companyRoleQuery->withColumn(sprintf('MIN(%s)', SpyCompanyRoleTableMap::COL_ID_COMPANY_ROLE), static::COL_FIRST_COMPANY_ROLE_ID)
            ->select([static::COL_FIRST_COMPANY_ROLE_ID])
            ->groupByName()
            ->find()
            ->toArray();

        return $clonedCompanyRoleQuery->clear()
            ->filterByIdCompanyRole_In($companyRoleIds);
    }
}
