<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer;
}
