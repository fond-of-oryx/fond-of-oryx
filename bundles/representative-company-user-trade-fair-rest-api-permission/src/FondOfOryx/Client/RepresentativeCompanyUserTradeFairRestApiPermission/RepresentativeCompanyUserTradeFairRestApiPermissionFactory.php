<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStub;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class RepresentativeCompanyUserTradeFairRestApiPermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface
     */
    public function createRepresentativeCompanyUserTradeFairRestApiPermissionStub(): RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface
    {
        return new RepresentativeCompanyUserTradeFairRestApiPermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
