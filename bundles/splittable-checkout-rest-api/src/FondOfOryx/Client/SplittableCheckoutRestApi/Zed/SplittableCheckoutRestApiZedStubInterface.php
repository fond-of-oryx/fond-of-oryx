<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Zed;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

interface SplittableCheckoutRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $splittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestAttributesTransfer $splittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer;
}
