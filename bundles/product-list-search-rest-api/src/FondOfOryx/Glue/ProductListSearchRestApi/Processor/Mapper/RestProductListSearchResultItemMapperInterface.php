<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListSearchResultItemTransfer;

interface RestProductListSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchResultItemTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListSearchResultItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestProductListSearchResultItemTransfer>
     */
    public function fromProductListCollection(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ArrayObject;
}
