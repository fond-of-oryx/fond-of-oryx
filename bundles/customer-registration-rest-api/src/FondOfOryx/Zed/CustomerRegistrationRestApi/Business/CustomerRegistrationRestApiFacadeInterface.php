<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\HandleKnownCustomerTransfer;

interface CustomerRegistrationRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\HandleKnownCustomerTransfer $handleKnownCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(HandleKnownCustomerTransfer $handleKnownCustomerTransfer): CustomerRegistrationKnownCustomerResponseTransfer;
}
