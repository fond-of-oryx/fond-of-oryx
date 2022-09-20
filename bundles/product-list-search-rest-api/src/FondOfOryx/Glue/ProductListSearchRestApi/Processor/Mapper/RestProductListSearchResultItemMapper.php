<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListSearchResultItemTransfer;

class RestProductListSearchResultItemMapper implements RestProductListSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListSearchResultItemTransfer
     */
    public function fromProductList(ProductListTransfer $productListTransfer): RestProductListSearchResultItemTransfer
    {
        return (new RestProductListSearchResultItemTransfer())
            ->fromArray($productListTransfer->toArray(), true)
            ->setProductListId($productListTransfer->getUuid());
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestProductListSearchResultItemTransfer>
     */
    public function fromProductListCollection(ProductListCollectionTransfer $productListCollectionTransfer): ArrayObject
    {
        $restProductListsAttributesTransfers = new ArrayObject();

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            $restProductListsAttributesTransfers->append($this->fromProductList($productListTransfer));
        }

        return $restProductListsAttributesTransfers;
    }
}
