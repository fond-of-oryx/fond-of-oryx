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
    public function findProductLists(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer;
}
