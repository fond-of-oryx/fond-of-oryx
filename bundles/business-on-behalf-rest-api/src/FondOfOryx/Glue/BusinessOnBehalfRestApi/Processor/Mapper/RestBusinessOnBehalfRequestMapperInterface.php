<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;

interface RestBusinessOnBehalfRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer
     */
    public function fromRestBusinessOnBehalfRequestAttributes(
        RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
    ): RestBusinessOnBehalfRequestTransfer;
}
