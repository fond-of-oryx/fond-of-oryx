<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\CompanyListTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;

interface CompanySearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\CompanyListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function addQueryFilters(
        SpyCompanyQuery $query,
        CompanyListTransfer $orderBudgetListTransfer
    ): SpyCompanyQuery;

    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function addInQueryFilters(
        SpyCompanyQuery $query,
        CompanyListTransfer $companyListTransfer
    ): SpyCompanyQuery;
}
