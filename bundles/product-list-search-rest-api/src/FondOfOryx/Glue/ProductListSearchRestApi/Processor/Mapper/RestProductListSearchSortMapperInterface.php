<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\RestProductListSearchSortTransfer;

interface RestProductListSearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchSortTransfer
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): RestProductListSearchSortTransfer;
}
