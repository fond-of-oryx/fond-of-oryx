<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi;

use FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStub;
use FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class SplittableTotalsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStubInterface
     */
    public function createSplittableTotalsRestApiZedStub(): SplittableTotalsRestApiZedStubInterface
    {
        return new SplittableTotalsRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): SplittableTotalsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(SplittableTotalsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
