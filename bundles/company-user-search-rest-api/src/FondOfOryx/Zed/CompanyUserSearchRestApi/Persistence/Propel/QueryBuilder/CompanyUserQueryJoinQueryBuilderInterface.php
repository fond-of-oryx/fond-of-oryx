<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery;

interface CompanyUserQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery
     */
    public function addQueryFilters(
        SpyCompanyUserQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyCompanyUserQuery;
}
