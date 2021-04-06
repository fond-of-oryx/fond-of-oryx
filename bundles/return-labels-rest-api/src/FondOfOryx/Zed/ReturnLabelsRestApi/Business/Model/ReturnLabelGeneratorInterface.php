<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use Generated\Shared\Transfer\RestReturnLabelTransfer;

interface ReturnLabelGeneratorInterface
{
    public function generate(RestReturnLabelTransfer $restReturnLabelTransfer): void;
}
