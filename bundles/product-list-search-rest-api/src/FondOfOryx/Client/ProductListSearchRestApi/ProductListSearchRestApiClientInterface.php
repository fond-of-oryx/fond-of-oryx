<?php

namespace FondOfOryx\Client\ProductListSearchRestApi;

use Generated\Shared\Transfer\ProductListCollectionTransfer;

interface ProductListSearchRestApiClientInterface
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
