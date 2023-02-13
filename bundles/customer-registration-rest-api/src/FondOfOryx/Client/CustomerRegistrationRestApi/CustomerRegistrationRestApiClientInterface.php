<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Generated\Shared\Transfer\HandleKnownCustomerTransfer;

interface CustomerRegistrationRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\HandleKnownCustomerTransfer $handleKnownCustomerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(HandleKnownCustomerTransfer $handleKnownCustomerTransfer): void;
}
