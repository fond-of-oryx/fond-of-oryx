<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

interface SearchProductListQueryExpanderInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer;
}
