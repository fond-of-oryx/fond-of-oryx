<?php

namespace FondOfOryx\Client\ErpOrderPermission;

use FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface;
use FondOfOryx\Client\ErpOrderPermission\Zed\ErpOrderPermissionStub;
use Spryker\Client\Kernel\AbstractFactory;

class ErpOrderPermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ErpOrderPermission\Zed\ErpOrderPermissionStubInterface
     */
    public function createErpOrderPermissionStub()
    {
        return new ErpOrderPermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): ErpOrderPermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(ErpOrderPermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
