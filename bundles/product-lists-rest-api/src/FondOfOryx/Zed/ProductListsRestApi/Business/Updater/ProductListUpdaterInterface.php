<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Updater;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;

interface ProductListUpdaterInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer
     */
    public function update(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateResponseTransfer;
}
