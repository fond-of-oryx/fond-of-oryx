<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiZedStub;
use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClient;

class CustomerRegistrationRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiZedStubInterface
     */
    public function createCustomerRegistrationRestApiZedStub(): CustomerRegistrationRestApiZedStubInterface
    {
        return new CustomerRegistrationRestApiZedStub($this->getZedClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected function getZedClient(): ZedRequestClient
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
