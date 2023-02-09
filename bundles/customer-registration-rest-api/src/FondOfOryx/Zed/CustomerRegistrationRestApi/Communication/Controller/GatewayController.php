<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Communication\Controller;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\CustomerRegistrationRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function handleKnownCustomerAction(CustomerTransfer $customerTransfer): void
    {
        $this->getFacade()->handleKnownCustomer($customerTransfer);
    }
}
