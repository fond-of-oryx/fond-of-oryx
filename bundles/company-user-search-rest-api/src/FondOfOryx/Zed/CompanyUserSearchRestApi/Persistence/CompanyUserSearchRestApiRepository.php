<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiPersistenceFactory getFactory()
 */
class CompanyUserSearchRestApiRepository extends AbstractRepository implements CompanyUserSearchRestApiRepositoryInterface
{
    /**
     * @var string
     */
    public const COL_FIRST_COMPANY_USER_ID = 'firstCompanyUserId';

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
        $companyUserQuery = $this->addOnlyOnePerCustomerFilter($companyUserQuery, $companyUserListTransfer);
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
            ->useCustomerQuery()
                ->filterByAnonymizedAt(null, Criteria::ISNULL)
            ->endUse()
            ->filterByIsActive(true);

        if (count($companyUserListTransfer->getCompanyRoleNames()) > 0) {
            $query = $query->useSpyCompanyRoleToCompanyUserQuery()
                    ->useCompanyRoleQuery()
                        ->filterByName_In($companyUserListTransfer->getCompanyRoleNames())
                    ->endUse()
                ->endUse();
        } else {
            $query = $query->innerJoinSpyCompanyRoleToCompanyUser();
        }

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

        $fulltextSearchFields = $this->getFactory()->getConfig()->getFulltextSearchFields();
        $conditionNames = [];
        $tableMaps = [
            SpyCompanyUserTableMap::getTableMap(),
            SpyCustomerTableMap::getTableMap(),
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
                $companyUserQuery->addCond($conditionName, $columnMap->getFullyQualifiedName(), sprintf('%%%s%%', $query), Criteria::ILIKE);

                break;
            }
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
    protected function addOnlyOnePerCustomerFilter(
        SpyCompanyUserQuery $companyUserQuery,
        CompanyUserListTransfer $companyUserListTransfer
    ): SpyCompanyUserQuery {
        if ($companyUserListTransfer->getOnlyOnePerCustomer() !== true) {
            return $companyUserQuery;
        }

        $clonedCompanyUserQuery = clone $companyUserQuery;

        $companyUserIds = $companyUserQuery->withColumn(sprintf('MIN(%s)', SpyCompanyUserTableMap::COL_ID_COMPANY_USER), static::COL_FIRST_COMPANY_USER_ID)
            ->select([static::COL_FIRST_COMPANY_USER_ID])
            ->groupByFkCustomer()
            ->find()
            ->toArray();

        return $clonedCompanyUserQuery->filterByIdCompanyUser_In($companyUserIds);
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

        $sortFields = $this->getFactory()->getConfig()->getSortFields();
        $tableMaps = [
            SpyCompanyUserTableMap::getTableMap(),
            SpyCustomerTableMap::getTableMap(),
        ];

        [$sortField, $direction] = explode(' ', preg_replace('/(([a-z0-9]+)(_[a-z0-9]+)*)_(asc|desc)/', '$1 $4', $sort));

        foreach ($tableMaps as $tableMap) {
            if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
                continue;
            }

            $columnMap = $tableMap->getColumn($sortField);

            $companyUserQuery->orderBy(
                $columnMap->getFullyQualifiedName(),
                $direction === 'desc' ? Criteria::DESC : Criteria::ASC,
            );

            if ($companyUserListTransfer->getOnlyOnePerCustomer() !== true) {
                return $companyUserQuery;
            }

            return $companyUserQuery->addAscendingOrderByColumn(SpyCompanyUserTableMap::COL_ID_COMPANY_USER);
        }

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
