<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class RestSplittableCheckoutMapper implements RestSplittableCheckoutMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutTransfer
     */
    public function fromSplittableCheckout(
        SplittableCheckoutTransfer $splittableCheckoutTransfer
    ): RestSplittableCheckoutTransfer {
        return (new RestSplittableCheckoutTransfer())
            ->fromArray(
                $splittableCheckoutTransfer->toArray(),
                true
            );
    }
}
