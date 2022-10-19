<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader;

use Generated\Shared\Transfer\ProductListCollectionTransfer;

interface ProductListReaderInterface
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
