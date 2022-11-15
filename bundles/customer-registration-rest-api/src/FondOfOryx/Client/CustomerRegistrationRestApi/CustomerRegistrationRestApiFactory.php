<?php

namespace FondOfOryx\Client\CustomerRegistrationRestApi;

use FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStub;
use FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CustomerRegistrationRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CustomerRegistrationRestApi\Zed\CustomerRegistrationRestApiStubInterface
     */
    public function createCustomerRegistrationZedStub(): CustomerRegistrationRestApiStubInterface
    {
        return new CustomerRegistrationRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToZedRequestClientInterface
     */
    public function getZedRequestClient(): CustomerRegistrationRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CustomerRegistrationRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
