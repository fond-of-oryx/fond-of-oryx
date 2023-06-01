<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence;

use ArrayObject;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\QueryBuilder\CompanySearchFilterFieldQueryBuilder;
use Generated\Shared\Transfer\CompanyListTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
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
        $query = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->filterByIsActive(true)
            ->useCompanyUserQuery()
                ->useCustomerQuery()
                    ->filterByCustomerReference($companyListTransfer->getCustomerReference())
                ->endUse()
                ->filterByIsActive(true)
            ->endUse();

        if ($companyListTransfer->getCompanyUuid() !== null) {
            $query->filterByUuid($companyListTransfer->getCompanyUuid());
        }

        $query = $this->getFactory()
            ->createCompanySearchFilterFieldQueryBuilder()
            ->addQueryFilters($query, $companyListTransfer);

        $queryJoinCollectionTransfer = $companyListTransfer->getQueryJoins();

        if ($queryJoinCollectionTransfer !== null && $queryJoinCollectionTransfer->getQueryJoins()->count() > 0) {
            $query = $this->getFactory()
                ->createCompanyQueryJoinQueryBuilder()
                ->addQueryFilters($query, $queryJoinCollectionTransfer);
        }

        if ($this->isSearchByAllFilterFieldSet($companyListTransfer)) {
            $query->where([CompanySearchFilterFieldQueryBuilder::CONDITION_GROUP_ALL]);
        }

        $query = $this->preparePagination($query, $companyListTransfer);

        $companies = $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityCollectionToTransfers($query->find());

        return $companyListTransfer->setCompanies(new ArrayObject($companies));
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return bool
     */
    protected function isSearchByAllFilterFieldSet(CompanyListTransfer $companyListTransfer): bool
    {
        foreach ($companyListTransfer->getFilterFields() as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() === CompanySearchRestApiConstants::FILTER_FIELD_TYPE_ALL) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyCompanyQuery $query,
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
