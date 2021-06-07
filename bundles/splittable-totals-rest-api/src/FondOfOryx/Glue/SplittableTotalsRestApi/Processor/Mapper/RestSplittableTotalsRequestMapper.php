<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class RestSplittableTotalsRequestMapper implements RestSplittableTotalsRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer $restSplittableTotalsRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer
     */
    public function fromRestSplittableTotalsRequestAttributes(
        RestSplittableTotalsRequestAttributesTransfer $restSplittableTotalsRequestAttributesTransfer
    ): RestSplittableTotalsRequestTransfer {
        return (new RestSplittableTotalsRequestTransfer())
            ->fromArray(
                $restSplittableTotalsRequestAttributesTransfer->toArray(),
                false
            );
    }
}
