<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
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
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function customerRegistration(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationResponseTransfer {
        return $this->facade->customerRegistration($customerRegistrationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function flagCustomerAsGdprAccepted(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        return $customerTransfer; //needed for merge

//        return $this->facade->flagCustomerAsGdprAccepted($customerTransfer);
    }
}
