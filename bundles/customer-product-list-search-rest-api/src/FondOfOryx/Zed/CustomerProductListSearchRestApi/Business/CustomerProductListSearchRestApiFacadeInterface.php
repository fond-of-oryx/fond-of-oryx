<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

interface CustomerProductListSearchRestApiFacadeInterface
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
