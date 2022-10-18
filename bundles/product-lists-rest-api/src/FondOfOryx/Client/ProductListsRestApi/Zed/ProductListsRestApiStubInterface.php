<?php

namespace FondOfOryx\Client\ProductListsRestApi\Zed;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

interface ProductListsRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function updateProductListByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer;
}
