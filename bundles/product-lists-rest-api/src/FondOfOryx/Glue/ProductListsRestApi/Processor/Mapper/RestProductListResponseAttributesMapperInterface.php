<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListResponseAttributesTransfer;

interface RestProductListResponseAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListResponseAttributesTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListResponseAttributesTransfer;
}
