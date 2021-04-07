<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiToReturnLabelFacadeInterface
{
    /**
     * @param ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return ReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer;
}
