<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\HandleKnownCustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\Business\CustomerRegistrationRestApiBusinessFactory getFactory()
 */
class CustomerRegistrationRestApiFacade extends AbstractFacade implements CustomerRegistrationRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\HandleKnownCustomerTransfer $handleKnownCustomerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(HandleKnownCustomerTransfer $handleKnownCustomerTransfer): CustomerRegistrationKnownCustomerResponseTransfer
    {
        return $this->getFactory()
            ->createCustomerRegistrationProcessor()
            ->handleKnownCustomer($handleKnownCustomerTransfer);
    }
}
