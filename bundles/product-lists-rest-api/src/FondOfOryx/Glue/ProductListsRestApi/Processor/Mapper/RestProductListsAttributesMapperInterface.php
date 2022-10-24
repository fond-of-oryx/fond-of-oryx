<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

interface RestProductListsAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListsAttributesTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListsAttributesTransfer;
}
