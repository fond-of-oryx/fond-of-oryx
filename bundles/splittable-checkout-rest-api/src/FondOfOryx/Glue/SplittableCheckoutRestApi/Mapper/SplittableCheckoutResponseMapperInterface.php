<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper;

use Generated\Shared\Transfer\RestSplittableCheckoutResponseAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

interface SplittableCheckoutResponseMapperInterface
{
    /**
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
