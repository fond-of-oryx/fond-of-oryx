<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi;

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
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void
    {
        $this->getFactory()
            ->createCustomerRegistrationProcessor()
            ->handleKnownCustomer($customerTransfer);
    }
}
