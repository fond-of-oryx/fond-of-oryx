<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use ArrayObject;
use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder\CompanyUserSearchFilterFieldQueryBuilder;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
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
        $query = $this->getBaseQuery($companyUserListTransfer);
        $query = $this->addCompanyQuery($query, $companyUserListTransfer);

        $query = $this->getFactory()
            ->createCompanyUserSearchFilterFieldQueryBuilder()
            ->addQueryFilters($query, $companyUserListTransfer);

        $queryJoinCollectionTransfer = $companyUserListTransfer->getQueryJoins();

        if ($queryJoinCollectionTransfer !== null && $queryJoinCollectionTransfer->getQueryJoins()->count() > 0) {
            $query = $this->getFactory()
                ->createCompanyUserQueryJoinQueryBuilder()
                ->addQueryFilters($query, $queryJoinCollectionTransfer);
        }

        if ($this->isSearchByAllFilterFieldSet($companyUserListTransfer)) {
            $query->where([CompanyUserSearchFilterFieldQueryBuilder::CONDITION_GROUP_ALL]);
        }

        $query = $this->addOnlyOnePerCustomerFilter($query, $companyUserListTransfer);

        $query = $this->preparePagination($query, $companyUserListTransfer);

        $companyUser = $this->getFactory()
            ->createCompanyUserMapper()
            ->mapEntityCollectionToTransfers($query->find());

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
            ->filterByIsActive(true);

        if (count($companyUserListTransfer->getEmails()) > 0) {
            $query = $query->useCustomerQuery()
                    ->filterByAnonymizedAt(null, Criteria::ISNULL)
                    ->filterByEmail_In($companyUserListTransfer->getEmails())
                ->endUse();
        } else {
            $query = $query->useCustomerQuery()
                    ->filterByAnonymizedAt(null, Criteria::ISNULL)
                ->endUse();
        }

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
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $companyUserQuery
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
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
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    protected function addOnlyOnePerCustomerFilter(
        SpyCompanyUserQuery $query,
        CompanyUserListTransfer $companyUserListTransfer
    ): SpyCompanyUserQuery {
        if ($companyUserListTransfer->getOnlyOnePerCustomer() !== true) {
            return $query;
        }

        $clonedCompanyUserQuery = clone $query;

        $params = [];
        $sql = $clonedCompanyUserQuery->withColumn(sprintf('MIN(%s)', SpyCompanyUserTableMap::COL_ID_COMPANY_USER), static::COL_FIRST_COMPANY_USER_ID)
            ->select([static::COL_FIRST_COMPANY_USER_ID])
            ->groupByFkCustomer()
            ->clearOrderByColumns()
            ->createSelectSql($params);

        return $query->where(sprintf('%s IN (%s)', SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $sql));
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return bool
     */
    protected function isSearchByAllFilterFieldSet(CompanyUserListTransfer $companyUserListTransfer): bool
    {
        foreach ($companyUserListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() === CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyUserQuery $query,
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
