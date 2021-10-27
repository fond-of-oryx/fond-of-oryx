<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStub;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyBusinessUnitSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStubInterface
     */
    public function createZedCompanyBusinessUnitSearchRestApiStub(): CompanyBusinessUnitSearchRestApiStubInterface
    {
        return new CompanyBusinessUnitSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyBusinessUnitSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
