<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory getFactory()
 */
class CustomerRegistrationRestApiClient extends AbstractClient implements CustomerRegistrationRestApiClientInterface
{
    /**
     * @return void
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void
    {
        $this->getFactory()->createCustomerRegistrationRestApiZedStub()->handleKnownCustomer($customerTransfer);
    }
}
