<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface;
use FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStub;
use FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class OneTimePasswordRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStubInterface
     */
    public function createOneTimePasswordZedStub(): OneTimePasswordRestApiStubInterface
    {
        return new OneTimePasswordRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface
     */
    public function getZedRequestClient(): OneTimePasswordRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(OneTimePasswordRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
