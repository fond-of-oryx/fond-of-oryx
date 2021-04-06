<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiFacadeInterface
{
    /**
     * Specifications:
     * - Create return label
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return void
     */
    public function generateReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
