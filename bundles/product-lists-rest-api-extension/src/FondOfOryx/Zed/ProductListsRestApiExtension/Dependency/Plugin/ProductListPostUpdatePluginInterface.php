<?php

namespace FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface ProductListPostUpdatePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function postUpdate(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer,
        ProductListTransfer $productListTransfer
    ): ProductListTransfer;
}
