<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Communication\Controller;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\Business\CustomerRegistrationRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomerAction(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer
    {
        return $this->getFacade()->handleKnownCustomer($customerTransfer);
    }
}
