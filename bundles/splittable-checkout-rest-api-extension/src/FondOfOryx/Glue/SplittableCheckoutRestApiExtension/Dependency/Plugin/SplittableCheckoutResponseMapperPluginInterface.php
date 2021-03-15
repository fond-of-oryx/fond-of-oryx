<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RestSplittableCheckoutResponseAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

interface SplittableCheckoutResponseMapperPluginInterface
{
    /**
     * Specification:
     * - Fills RestSplittableCheckoutResponseAttributesTransfer's properties using data from RestSplittableCheckoutResponseTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutResponseAttributesTransfer $restSplittableCheckoutResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutResponseAttributesTransfer
     */
    public function mapRestSplittableCheckoutResponseTransferToRestSplittableCheckoutResponseAttributesTransfer(
        RestSplittableCheckoutResponseTransfer $restSplittableCheckoutResponseTransfer,
        RestSplittableCheckoutResponseAttributesTransfer $restSplittableCheckoutResponseAttributesTransfer
    ): RestSplittableCheckoutResponseAttributesTransfer;
}
