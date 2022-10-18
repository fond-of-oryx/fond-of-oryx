<?php

namespace FondOfOryx\Client\ProductListsRestApi\Zed;

use FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

class ProductListsRestApiStub implements ProductListsRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(ProductListsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function updateProductListByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer $restProductListUpdateResponseTransfer */
        $restProductListUpdateResponseTransfer = $this->zedRequestClient->call(
            '/product-lists-rest-api/gateway/update-product-list-by-rest-product-list-update-request',
            $restProductListUpdateRequestTransfer,
        );

        return $restProductListUpdateResponseTransfer;
    }
}
