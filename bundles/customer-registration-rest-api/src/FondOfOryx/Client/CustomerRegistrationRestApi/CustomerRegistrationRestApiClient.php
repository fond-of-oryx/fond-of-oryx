<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use Generated\Shared\Transfer\HandleKnownCustomerTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiFactory getFactory()
 */
class CustomerRegistrationRestApiClient extends AbstractClient implements CustomerRegistrationRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\HandleKnownCustomerTransfer $handleKnownCustomerTransfer
     *
     * @return void
     */
    public function handleKnownCustomer(HandleKnownCustomerTransfer $handleKnownCustomerTransfer): void
    {
        $this->getFactory()
            ->createCustomerRegistrationRestApiZedStub()
            ->handleKnownCustomer($handleKnownCustomerTransfer);
    }
}
