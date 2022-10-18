<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Persistence;

use Generated\Shared\Transfer\ProductListCollectionTransfer;

interface ProductListSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer;
}
