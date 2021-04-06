<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Zed;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
