<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission;

use FondOfOryx\Client\RepresentationOfSalesPermission\Dependency\Client\RepresentationOfSalesPermissionToZedRequestInterface;
use FondOfOryx\Client\RepresentationOfSalesPermission\Zed\RepresentationOfSalesPermissionStub;
use FondOfOryx\Client\RepresentationOfSalesPermission\Zed\RepresentationOfSalesPermissionStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class RepresentationOfSalesPermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\RepresentationOfSalesPermission\Zed\RepresentationOfSalesPermissionStubInterface
     */
    public function createRepresentationOfSalesPermissionStub(): RepresentationOfSalesPermissionStubInterface
    {
        return new RepresentationOfSalesPermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\RepresentationOfSalesPermission\Dependency\Client\RepresentationOfSalesPermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): RepresentationOfSalesPermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(RepresentationOfSalesPermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
