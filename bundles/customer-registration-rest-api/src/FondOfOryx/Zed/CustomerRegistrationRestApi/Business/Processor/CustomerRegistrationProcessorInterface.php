<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer;
}
