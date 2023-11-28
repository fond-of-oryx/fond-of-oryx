<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerQuoteConnectorToCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomer(CustomerTransfer $customerTransfer): CustomerTransfer;
}
