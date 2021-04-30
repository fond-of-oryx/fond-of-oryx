<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Mapper;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestMapper implements ReturnLabelRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function mapRestReturnLabelRequestToReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        return (new ReturnLabelRequestTransfer())
            ->setIdCustomer($restReturnLabelRequestTransfer->getIdCustomer());
    }
}
