<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;

interface SplittableCheckoutRequestValidatorPluginInterface
{
    /**
     * Specification:
     * - Validates splittable checkout Rest API request attributes.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    public function validateAttributes(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestErrorCollectionTransfer;
}
