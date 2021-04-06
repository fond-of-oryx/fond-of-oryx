<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelsRestApiToReturnLabelFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     */
    public function generateReturnLabel(ReturnLabelRequestTransfer $returnLabelRequestTransfer): void;
}
