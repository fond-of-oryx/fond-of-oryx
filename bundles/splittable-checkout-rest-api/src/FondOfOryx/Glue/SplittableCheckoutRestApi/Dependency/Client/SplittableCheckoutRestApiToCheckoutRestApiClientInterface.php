<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;

interface SplittableCheckoutRestApiToCheckoutRestApiClientInterface
{
    /**
     * Specification:
     * - Looks up the customer quote by uuid.
     * - splits order based on delivery date
     * - Validates quote.
     * - Executes plugins that maps request data into QuoteTransfer.
     * - Recalculates quote.
     * - Places an order.
     * - Deletes quote if order was placed successfully.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutResponseTransfer
     */
    public function placeOrder(
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCheckoutResponseTransfer;
}
