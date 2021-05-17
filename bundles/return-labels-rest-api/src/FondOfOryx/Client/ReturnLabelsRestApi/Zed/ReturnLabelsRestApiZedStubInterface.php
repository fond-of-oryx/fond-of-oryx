<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;

interface ReturnLabelsRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer;
}
