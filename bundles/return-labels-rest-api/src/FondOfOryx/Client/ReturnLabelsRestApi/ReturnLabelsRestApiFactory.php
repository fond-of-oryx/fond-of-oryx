<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStub;
use FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface;
use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToCompanyUserReferenceClientInterface;
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
     * @return ReturnLabelsRestApiToCompanyUserReferenceClientInterface
     */
    public function getCompanyUserReferenceClient(): ReturnLabelsRestApiToCompanyUserReferenceClientInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::CLIENT_COMPANY_USER_REFERENCE_CLIENT);
    }

    /**
     * @return \FondOfOryx\Client\ReturnLabelsRestApi\Zed\ReturnLabelsRestApiZedStubInterface
     */
    public function createReturnLabelZedStub(): ReturnLabelsRestApiZedStubInterface
    {
        return new ReturnLabelsRestApiZedStub(
            $this->getZedRequestClient()
        );
    }
}
