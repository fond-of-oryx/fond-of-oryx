<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestMapper implements ReturnLabelRequestMapperInterface
{
    /**
     * @param RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return ReturnLabelRequestTransfer
     */
    public function mapRestReturnLabelRequestToReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRequestTransfer
    {
        return (new ReturnLabelRequestTransfer)
            ->fromArray($restReturnLabelRequestTransfer->toArray(), true);
    }
}
