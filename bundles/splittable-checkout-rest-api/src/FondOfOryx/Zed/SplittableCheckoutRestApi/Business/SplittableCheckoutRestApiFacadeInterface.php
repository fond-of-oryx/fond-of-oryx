<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

interface SplittableCheckoutRestApiFacadeInterface
{
    /**
     * Specification:
     * - Looks up the customer quote by uuid.
     * - Validates quote.
     * - Executes plugins that maps request data into QuoteTransfer.
     * - Recalculates quote.
     * - Places an order.
     * - Deletes quote if order was placed successfully.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    public function placeOrder(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutResponseTransfer;
}
