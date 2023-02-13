<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Communication\Controller;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\HandleKnownCustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\Business\CustomerRegistrationRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\HandleKnownCustomerTransfer $handleKnownCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomerAction(HandleKnownCustomerTransfer $handleKnownCustomerTransfer): CustomerRegistrationKnownCustomerResponseTransfer
    {
        return $this->getFacade()->handleKnownCustomer($handleKnownCustomerTransfer);
    }
}
