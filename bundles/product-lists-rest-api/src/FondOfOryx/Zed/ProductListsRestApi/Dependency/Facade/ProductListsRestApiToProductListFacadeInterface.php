<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListsRestApiToProductListFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function getProductListById(ProductListTransfer $productListTransfer): ProductListTransfer;

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListResponseTransfer
     */
    public function updateProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
