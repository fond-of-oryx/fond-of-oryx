<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\ZedRequest\Client\ZedClient;

class CustomerRegistrationRestApiZedStub implements CustomerRegistrationRestApiZedStubInterface
{
    protected const URL_HANDLE_KNOWN_CUSTOMER = '/customer-registration-rest-api/gateway/handle-known-customer';

    /**
     * @var \Spryker\Client\ZedRequest\Client\ZedClient
     */
    protected ZedClient $zedClient;

    /**
     * @param \Spryker\Client\ZedRequest\Client\ZedClient $zedClient
     */
    public function __construct(ZedClient $zedClient)
    {

        $this->zedClient = $zedClient;
    }

    public function handleKnownCustomer(CustomerTransfer $customerTransfer): void
    {
        $this->zedClient->call(static::URL_HANDLE_KNOWN_CUSTOMER, $customerTransfer);
    }
}
