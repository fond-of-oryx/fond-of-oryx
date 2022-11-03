<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListResponseAttributesTransfer;

class RestProductListResponseAttributesMapper implements RestProductListResponseAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListResponseAttributesTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListResponseAttributesTransfer
    {
        return (new RestProductListResponseAttributesTransfer())
            ->fromArray($productListTransfer->toArray(), true);
    }
}
