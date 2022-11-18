<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Dependency\Facade;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationSalesConnectorToCustomerRegistrationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer
     */
    public function customerRegistration(
        CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
    ): CustomerRegistrationResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function flagCustomerAsGdprAccepted(CustomerTransfer $customerTransfer): CustomerTransfer;
}
