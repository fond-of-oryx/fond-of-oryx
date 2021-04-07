<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper;

use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;

class RestReturnLabelResponseMapper
{
    /**
     * @return void
     */
    public function mapReturnLabelResponseToRestReturnLabelResponse(
        ReturnLabelResponseTransfer $returnLabelResponseTransfer
    ): RestReturnLabelResponseTransfer {
        (new RestReturnLabelResponseTransfer())->set
    }
}
