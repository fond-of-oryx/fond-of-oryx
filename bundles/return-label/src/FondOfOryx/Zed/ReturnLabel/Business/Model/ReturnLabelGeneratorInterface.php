<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

interface ReturnLabelGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     */
    public function generate(ReturnLabelRequestTransfer $returnLabelRequestTransfer): void;
}
