<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence\Propel\QueryBuilder;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;

interface ProductListSearchFilterFieldQueryBuilderInterface
{
    /**
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListQuery $query
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListQuery
     */
    public function addQueryFilters(
        SpyProductListQuery $query,
        ProductListCollectionTransfer $productListCollectionTransfer
    ): SpyProductListQuery;
}
