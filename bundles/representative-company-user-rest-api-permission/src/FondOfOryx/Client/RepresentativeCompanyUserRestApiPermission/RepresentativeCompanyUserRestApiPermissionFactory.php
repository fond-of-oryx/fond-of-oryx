<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission;

use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStub;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class RepresentativeCompanyUserRestApiPermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStubInterface
     */
    public function createRepresentativeCompanyUserRestApiPermissionStub(): RepresentativeCompanyUserRestApiPermissionStubInterface
    {
        return new RepresentativeCompanyUserRestApiPermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): RepresentativeCompanyUserRestApiPermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(RepresentativeCompanyUserRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
