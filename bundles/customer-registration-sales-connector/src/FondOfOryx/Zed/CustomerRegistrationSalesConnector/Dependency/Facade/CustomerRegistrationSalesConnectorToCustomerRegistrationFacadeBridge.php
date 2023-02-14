<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeBridge implements CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface $facade
     */
    public function __construct(CustomerRegistrationFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerRegistrationTransfer $customerRegistrationTransfer): void
    {
        $this->facade->handleKnownCustomer();
    }
}
