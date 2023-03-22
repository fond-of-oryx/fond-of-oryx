<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationTransfer;

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
     * @param \Generated\Shared\Transfer\CustomerRegistrationTransfer $customerRegistrationTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(CustomerRegistrationTransfer $customerRegistrationTransfer): void
    {
        $this->facade->handleKnownCustomer($customerRegistrationTransfer);
    }
}
