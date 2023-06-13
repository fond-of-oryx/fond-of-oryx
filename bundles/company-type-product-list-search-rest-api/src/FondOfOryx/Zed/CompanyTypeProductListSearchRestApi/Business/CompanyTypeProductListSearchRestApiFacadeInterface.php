<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

interface CompanyTypeProductListSearchRestApiFacadeInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expandSearchProductListQuery(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer;
}
