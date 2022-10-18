<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;

interface QuoteQueryJoinQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $productListQuery
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function addQueryFilters(
        SpyProductListQuery $productListQuery,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): SpyProductListQuery;
}
