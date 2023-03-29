<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;

class RestBusinessOnBehalfRequestMapper implements RestBusinessOnBehalfRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer
     */
    public function fromRestBusinessOnBehalfRequestAttributes(
        RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
    ): RestBusinessOnBehalfRequestTransfer {
        return (new RestBusinessOnBehalfRequestTransfer())
            ->fromArray($restBusinessOnBehalfRequestAttributesTransfer->toArray(), true);
    }
}
