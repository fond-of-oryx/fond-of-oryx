<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStub;
use Spryker\Client\Kernel\AbstractFactory;

class CompaniesRestApiPermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStubInterface
     */
    public function createCompaniesRestApiPermissionStub()
    {
        return new CompaniesRestApiPermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): CompaniesRestApiPermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(CompaniesRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
