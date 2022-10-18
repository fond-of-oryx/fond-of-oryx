<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

interface ProductListsRestApiFacadeInterface
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
