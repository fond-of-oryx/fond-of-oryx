<?php

namespace FondOfOryx\Zed\ReturnLabel\Business;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelFacadeInterface
{
    public function generateReturnLabel(ReturnLabelRequestTransfer $returnLabelRequestTransfer);
}
