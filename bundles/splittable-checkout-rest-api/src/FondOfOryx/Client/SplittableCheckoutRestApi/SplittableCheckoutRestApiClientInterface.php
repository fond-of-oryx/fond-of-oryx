<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

interface SplittableCheckoutRestApiClientInterface
{
    /**
     * Specifications:
     * - TODO: Put correct specifications here
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableCheckoutResponseTransfer;
}
