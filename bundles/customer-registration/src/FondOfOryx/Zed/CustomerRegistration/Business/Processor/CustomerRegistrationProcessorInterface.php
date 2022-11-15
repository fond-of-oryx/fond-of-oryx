<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;

interface CustomerRegistrationProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function processCustomerRegistration(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationResponseTransfer;
}
