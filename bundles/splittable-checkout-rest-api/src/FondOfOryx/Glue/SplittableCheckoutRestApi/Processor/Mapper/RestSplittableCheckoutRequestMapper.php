<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class RestSplittableCheckoutRequestMapper implements RestSplittableCheckoutRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer
     */
    public function fromRestSplittableCheckoutRequestAttributes(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestSplittableCheckoutRequestTransfer {
        return (new RestSplittableCheckoutRequestTransfer())
            ->fromArray(
                $restSplittableCheckoutRequestAttributesTransfer->toArray(),
                false
            );
    }
}
