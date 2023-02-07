<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationRestApiToCustomerClientInterface
{
    public function registerCustomer(CustomerTransfer $customerTransfer): CustomerResponseTransfer;
}
