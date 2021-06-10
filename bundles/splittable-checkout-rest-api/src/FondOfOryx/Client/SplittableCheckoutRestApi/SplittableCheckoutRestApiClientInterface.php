<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

interface SplittableCheckoutRestApiClientInterface
{
    /**
     * Specifications:
     * - Makes Zed request.
     * - Provides required data for the checkout process on data passed in RestSplittableCheckoutRequestTransfer.
     * - Checkout data will include available shipping methods, available payment methods and available customer addresses.
     * - Recalculates quote.
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

    /**
     * Specifications:
     * - Makes Zed request.
     * - Splits quote by split item attribute
     * - Recalculates split quotes
     * - Retrieves totals per splitted quote
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer
     */
    public function getSplittableTotals(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): RestSplittableTotalsResponseTransfer;
}
