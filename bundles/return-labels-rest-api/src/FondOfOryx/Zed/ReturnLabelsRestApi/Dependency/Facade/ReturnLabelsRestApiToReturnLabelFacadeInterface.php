<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelsRestApiToReturnLabelFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
