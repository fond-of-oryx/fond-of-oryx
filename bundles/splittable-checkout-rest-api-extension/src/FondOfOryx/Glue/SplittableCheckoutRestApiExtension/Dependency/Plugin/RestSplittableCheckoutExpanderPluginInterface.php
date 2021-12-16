<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

interface RestSplittableCheckoutExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutTransfer $restSplittableCheckoutTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutTransfer
     */
    public function expand(
        SplittableCheckoutTransfer $splittableCheckoutTransfer,
        RestSplittableCheckoutTransfer $restSplittableCheckoutTransfer
    ): RestSplittableCheckoutTransfer;
}
