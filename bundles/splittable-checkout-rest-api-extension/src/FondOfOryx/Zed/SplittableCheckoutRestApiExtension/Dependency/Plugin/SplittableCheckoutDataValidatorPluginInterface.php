<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\SplittableCheckoutDataTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;

interface SplittableCheckoutDataValidatorPluginInterface
{
    /**
     * Specification:
     * - Validates checkout data.
     * - Returns CheckoutResponseTransfer if there is invalid data in RestCheckoutRequestAttributesTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function validateSplittableCheckoutData(
        SplittableCheckoutDataTransfer $splittableCheckoutDataTransfer
    ): SplittableCheckoutResponseTransfer;
}
