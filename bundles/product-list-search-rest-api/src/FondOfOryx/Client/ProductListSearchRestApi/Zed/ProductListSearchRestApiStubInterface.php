<?php

namespace FondOfOryx\Client\ProductListSearchRestApi\Zed;

use Generated\Shared\Transfer\ProductListCollectionTransfer;

interface ProductListSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function searchProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer;
}
