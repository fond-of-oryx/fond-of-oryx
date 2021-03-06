<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer;

class ReturnLabelRequestCustomerMapper implements ReturnLabelRequestCustomerMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer
     */
    public function fromCustomerTransfer(CustomerTransfer $customerTransfer): ReturnLabelRequestCustomerTransfer
    {
        return $returnLabelRequestCustomerTransfer = (new ReturnLabelRequestCustomerTransfer())
            ->setEmail($customerTransfer->getEmail());
    }
}
