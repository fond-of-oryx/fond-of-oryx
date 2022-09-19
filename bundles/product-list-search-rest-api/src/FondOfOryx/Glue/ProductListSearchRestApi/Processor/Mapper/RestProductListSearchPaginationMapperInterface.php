<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchPaginationTransfer;

interface RestProductListSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchPaginationTransfer
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestProductListSearchPaginationTransfer;
}
