<?php

namespace FondOfOryx\Client\ReturnLabelRestApi;

use FondOfOryx\Client\ReturnLabelRestApi\Dependency\Client\ReturnLabelRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ReturnLabelRestApi\Zed\ReturnLabelRestApiZedStub;
use FondOfOryx\Client\ReturnLabelRestApi\Zed\ReturnLabelRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ReturnLabelRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ReturnLabelRestApi\Dependency\Client\ReturnLabelRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): ReturnLabelRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ReturnLabelRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \FondOfOryx\Client\ReturnLabelRestApi\Zed\ReturnLabelRestApiZedStubInterface
     */
    public function createReturnLabelZedStub(): ReturnLabelRestApiZedStubInterface
    {
        return new ReturnLabelRestApiZedStub(
            $this->getZedRequestClient()
        );
    }
}
