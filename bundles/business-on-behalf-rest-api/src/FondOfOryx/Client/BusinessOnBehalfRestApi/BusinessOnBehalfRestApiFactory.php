<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi;

use FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStub;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class BusinessOnBehalfRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStubInterface
     */
    public function createBusinessOnBehalfRestApiZedStub(): BusinessOnBehalfRestApiZedStubInterface
    {
        return new BusinessOnBehalfRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): BusinessOnBehalfRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(BusinessOnBehalfRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
