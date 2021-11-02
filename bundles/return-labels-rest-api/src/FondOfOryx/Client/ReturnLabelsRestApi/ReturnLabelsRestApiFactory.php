<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStub;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ReturnLabelsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): ReturnLabelsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }

    /**
     * @return \FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface
     */
    public function createReturnLabelZedStub(): ReturnLabelsRestApiZedStubInterface
    {
        return new ReturnLabelsRestApiZedStub(
            $this->getZedRequestClient(),
        );
    }
}
