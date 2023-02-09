<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void;
}
