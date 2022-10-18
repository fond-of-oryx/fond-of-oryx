<?php

namespace FondOfOryx\Client\CustomerTokenManager\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerTokenManagerToCustomerClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function findCustomerByReference(CustomerTransfer $customerTransfer): CustomerResponseTransfer;
}
