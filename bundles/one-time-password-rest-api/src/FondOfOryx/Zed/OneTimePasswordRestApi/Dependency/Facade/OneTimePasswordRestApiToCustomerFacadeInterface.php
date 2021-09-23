<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordRestApiToCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;
}
