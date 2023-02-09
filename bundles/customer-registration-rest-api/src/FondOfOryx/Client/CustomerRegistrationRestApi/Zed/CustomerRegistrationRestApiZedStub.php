<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi\Zed;

use Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class CustomerRegistrationRestApiZedStub implements CustomerRegistrationRestApiZedStubInterface
{
    /**
     * @var string
     */
    protected const URL_HANDLE_KNOWN_CUSTOMER = '/customer-registration-rest-api/gateway/handle-known-customer';

    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected ZedRequestClient $zedClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedClient
     */
    public function __construct(ZedRequestClient $zedClient)
    {
        $this->zedClient = $zedClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer
     */
    public function handleKnownCustomer(CustomerTransfer $customerTransfer): CustomerRegistrationKnownCustomerResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerRegistrationKnownCustomerResponseTransfer $knownCustomerResponse */
        $knownCustomerResponse = $this->zedClient->call(static::URL_HANDLE_KNOWN_CUSTOMER, $customerTransfer);

        return $knownCustomerResponse;
    }
}
