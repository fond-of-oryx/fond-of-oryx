<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;

interface CompanyUserSearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $orderBudgetListTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function addQueryFilters(
        SpyCompanyUserQuery $query,
        CompanyUserListTransfer $orderBudgetListTransfer
    ): SpyCompanyUserQuery;
}
