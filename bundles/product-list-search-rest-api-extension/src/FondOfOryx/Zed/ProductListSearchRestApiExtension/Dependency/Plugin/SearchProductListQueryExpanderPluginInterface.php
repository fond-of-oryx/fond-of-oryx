<?php

namespace FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;

interface SearchProductListQueryExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands QueryJoinCollectionTransfer with additional QueryJoinTransfers.
     *
     * @api
     *
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
