<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;

interface CompanyQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery $query
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function addQueryFilters(
        SpyCompanyQuery $query,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyCompanyQuery;
}
