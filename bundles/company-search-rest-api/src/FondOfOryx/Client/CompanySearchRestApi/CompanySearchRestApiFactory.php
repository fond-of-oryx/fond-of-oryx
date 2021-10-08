<?php

namespace FondOfOryx\Client\CompanySearchRestApi;

use FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStub;
use FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanySearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStubInterface
     */
    public function createZedCompanySearchRestApiStub(): CompanySearchRestApiStubInterface
    {
        return new CompanySearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanySearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanySearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
