<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Processor;

use Generated\Shared\Transfer\CustomerRegistrationTransfer;

interface CustomerRegistrationHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerRegistrationTransfer $customerRegistrationTransfer): void;
}
