<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListTransfer;

class RestProductListMapper implements RestProductListMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListTransfer
    {
        return (new RestProductListTransfer())
            ->fromArray($productListTransfer->toArray(), true);
    }
}
