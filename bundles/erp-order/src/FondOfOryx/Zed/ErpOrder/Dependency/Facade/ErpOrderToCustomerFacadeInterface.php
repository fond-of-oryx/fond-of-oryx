<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface ErpOrderToCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;
}
