<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStub;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class SplittableCheckoutRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface
     */
    public function createSplittableCheckoutRestApiZedStub(): SplittableCheckoutRestApiZedStubInterface
    {
        return new SplittableCheckoutRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): SplittableCheckoutRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
