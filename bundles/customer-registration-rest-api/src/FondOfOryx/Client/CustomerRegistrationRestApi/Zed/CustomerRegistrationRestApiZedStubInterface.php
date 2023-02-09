<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void;
}
