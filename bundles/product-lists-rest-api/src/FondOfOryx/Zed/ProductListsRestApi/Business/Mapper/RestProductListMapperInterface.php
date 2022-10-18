<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListTransfer;

interface RestProductListMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListTransfer;
}
