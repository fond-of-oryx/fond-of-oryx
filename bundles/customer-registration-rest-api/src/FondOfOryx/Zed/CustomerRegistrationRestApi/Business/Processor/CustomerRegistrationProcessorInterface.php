<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business\Processor;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationProcessorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void;
}
