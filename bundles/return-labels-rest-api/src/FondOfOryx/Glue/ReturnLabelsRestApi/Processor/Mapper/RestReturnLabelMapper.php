<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestReturnLabelTransfer;
use Generated\Shared\Transfer\ReturnLabelTransfer;

class RestReturnLabelMapper implements RestReturnLabelMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelTransfer $returnLabelTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelTransfer
     */
    public function fromReturnLabel(ReturnLabelTransfer $returnLabelTransfer): RestReturnLabelTransfer
    {
        return (new RestReturnLabelTransfer())
            ->fromArray($returnLabelTransfer->toArray(), true);
    }
}
