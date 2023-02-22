<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerRegistrationTransfer;

interface CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(
        CustomerRegistrationTransfer $customerRegistrationTransfer
    ): void;
}
