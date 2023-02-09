<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Business;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationRestApi\Business\CustomerRegistrationRestApiBusinessFactory getFactory()
 */
class CustomerRegistrationRestApiFacade extends AbstractFacade implements CustomerRegistrationRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer
    {
        return $this->getFactory()
            ->createCustomerRegistrationProcessor()
            ->handleKnownCustomer($customerTransfer);
    }
}
