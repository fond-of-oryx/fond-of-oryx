<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

interface SplittableCheckoutRestApiFacadeInterface
{
    /**
     * Specifications:
     * - Place orders by splitted quotes
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
