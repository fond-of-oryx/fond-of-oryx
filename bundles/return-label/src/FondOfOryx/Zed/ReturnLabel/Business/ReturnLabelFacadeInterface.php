<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

interface ReturnLabelFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRestApiResponseTransfer;
}
