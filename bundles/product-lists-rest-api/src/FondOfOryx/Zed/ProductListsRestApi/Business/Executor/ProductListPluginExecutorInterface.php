<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Executor;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface ProductListPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return bool
     */
    public function executeUpdatePreCheckPlugins(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function executePostUpdatePlugins(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer;
}
