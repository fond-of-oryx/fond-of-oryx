<?php

namespace FondOfOryx\Client\ProductListSearchRestApi\Zed;

use FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class ProductListSearchRestApiStub implements ProductListSearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ProductListSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCollectionTransfer
     */
    public function findProductList(
        ProductListCollectionTransfer $productListCollectionTransfer
    ): ProductListCollectionTransfer {
        /** @var \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer */
        $productListCollectionTransfer = $this->zedRequestClient->call(
            '/product-list-search-rest-api/gateway/find-product-list',
            $productListCollectionTransfer,
        );

        return $productListCollectionTransfer;
    }
}
