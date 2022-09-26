<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Expander;

use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface ProductListExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function expand(
        ProductListTransfer $productListTransfer,
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): ProductListTransfer;
}
