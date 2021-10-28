<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\CompanyBusinessUnitSearchRestApiPersistenceFactory getFactory()
 */
class CompanyBusinessUnitSearchRestApiRepository extends AbstractRepository implements CompanyBusinessUnitSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer
    {
        $companyBusinessUnitQuery = $this->getBaseQuery();
        $companyBusinessUnitQuery = $this->addCompanyQuery($companyBusinessUnitQuery, $companyBusinessUnitListTransfer);

        $companyBusinessUnitQuery = $this->addSort($companyBusinessUnitQuery, $companyBusinessUnitListTransfer);
        $companyBusinessUnitQuery = $this->preparePagination($companyBusinessUnitQuery, $companyBusinessUnitListTransfer);

        $companyBusinessUnit = $this->getFactory()
            ->createCompanyBusinessUnitMapper()
            ->mapEntityCollectionToTransfers($companyBusinessUnitQuery->find());

        return $companyBusinessUnitListTransfer->setCompanyBusinessUnits(new ArrayObject($companyBusinessUnit));
    }

    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    protected function getBaseQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear();
    }

    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    protected function addCompanyQuery(
        SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery,
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): SpyCompanyBusinessUnitQuery {
        if ($companyBusinessUnitListTransfer->getCompanyUuid() !== null) {
            return $companyBusinessUnitQuery
                ->useCompanyQuery()
                    ->useCompanyUserQuery()
                        ->filterByFkCustomer($companyBusinessUnitListTransfer->getCustomerId())
                        ->filterByIsActive(true)
                    ->endUse()
                    ->filterByUuid($companyBusinessUnitListTransfer->getCompanyUuid())
                    ->filterByIsActive(true)
                ->endUse();
        }

        return $companyBusinessUnitQuery
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->filterByFkCustomer($companyBusinessUnitListTransfer->getCustomerId())
                    ->filterByIsActive(true)
                    ->leftJoinCustomer()
                ->endUse()
                ->filterByIsActive(true)
            ->endUse();
    }

    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    protected function addSort(
        SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery,
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): SpyCompanyBusinessUnitQuery {
        $sort = $companyBusinessUnitListTransfer->getSort();

        if ($sort === null) {
            return $companyBusinessUnitQuery;
        }

        $tableMap = SpyCompanyBusinessUnitTableMap::getTableMap();
        $sortFields = $this->getFactory()->getConfig()->getSortFields();

        [$sortField, $direction] = explode(' ', preg_replace('/(([a-z]+)(_[a-z]+)*)_(asc|desc)/', '$1 $4', $sort));

        if (!in_array($sortField, $sortFields, true) || !$tableMap->hasColumn($sortField)) {
            return $companyBusinessUnitQuery;
        }

        $columnMap = $tableMap->getColumn($sortField);

        $companyBusinessUnitQuery->orderBy(
            $columnMap->getFullyQualifiedName(),
            $direction === 'desc' ? Criteria::DESC : Criteria::ASC
        );

        return $companyBusinessUnitQuery;
    }

    /**
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyBusinessUnitQuery $companyBusinessUnitQuery,
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $companyBusinessUnitListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $companyBusinessUnitQuery->paginate($page, $maxPerPage);

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
