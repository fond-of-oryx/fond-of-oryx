<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

interface RestReturnLabelRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelRequestTransfer
     */
    public function fromRestReturnLabelRequestAttributes(
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestReturnLabelRequestTransfer;
}
