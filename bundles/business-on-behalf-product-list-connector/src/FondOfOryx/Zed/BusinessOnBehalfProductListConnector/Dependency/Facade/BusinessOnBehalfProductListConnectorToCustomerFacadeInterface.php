<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;

interface BusinessOnBehalfProductListConnectorToCustomerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomerById(CustomerTransfer $customerTransfer): ?CustomerTransfer;
}
