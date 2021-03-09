<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout;

use Generated\Shared\Transfer\RestSplittableCheckoutDataResponseTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;

interface SplittableCheckoutDataReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutDataResponseTransfer
     */
    public function getCheckoutData(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutDataResponseTransfer;
}
