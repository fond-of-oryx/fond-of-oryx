<?php

namespace FondOfOryx\Zed\ProductListsRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

interface RestProductListUpdateRequestExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer
     */
    public function expand(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): RestProductListUpdateRequestTransfer;
}
