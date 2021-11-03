<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi;

use FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStub;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompanyRoleSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStubInterface
     */
    public function createZedCompanyRoleSearchRestApiStub(): CompanyRoleSearchRestApiStubInterface
    {
        return new CompanyRoleSearchRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompanyRoleSearchRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompanyRoleSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
