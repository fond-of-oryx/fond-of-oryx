<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void;
}
