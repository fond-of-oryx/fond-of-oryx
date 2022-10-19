<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business;

use Generated\Shared\Transfer\ProductListCollectionTransfer;

interface ProductListSearchRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds product lists
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer;
}
