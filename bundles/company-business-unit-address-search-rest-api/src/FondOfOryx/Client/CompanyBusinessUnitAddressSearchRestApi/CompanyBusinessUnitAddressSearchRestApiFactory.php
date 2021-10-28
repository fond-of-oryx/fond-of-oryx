<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi;

use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStub;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyBusinessUnitAddressSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStubInterface
     */
    public function createZedCompanyBusinessUnitAddressSearchRestApiStub(): CompanyBusinessUnitAddressSearchRestApiStubInterface
    {
        return new CompanyBusinessUnitAddressSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
