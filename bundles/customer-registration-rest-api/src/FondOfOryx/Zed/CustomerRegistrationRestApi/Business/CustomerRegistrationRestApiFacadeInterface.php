<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer;
}
