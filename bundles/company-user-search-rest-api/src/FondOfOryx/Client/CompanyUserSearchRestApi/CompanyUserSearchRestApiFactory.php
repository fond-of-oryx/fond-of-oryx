<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi;

use FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStub;
use FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyUserSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStubInterface
     */
    public function createZedCompanyUserSearchRestApiStub(): CompanyUserSearchRestApiStubInterface
    {
        return new CompanyUserSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyUserSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyUserSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
