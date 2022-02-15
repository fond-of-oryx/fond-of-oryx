<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission;

use FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface;
use FondOfOryx\Client\ErpDeliveryNotePermission\Zed\ErpDeliveryNotePermissionStub;
use Spryker\Client\Kernel\AbstractFactory;

class ErpDeliveryNotePermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ErpDeliveryNotePermission\Zed\ErpDeliveryNotePermissionStubInterface
     */
    public function createErpDeliveryNotePermissionStub()
    {
        return new ErpDeliveryNotePermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\ErpDeliveryNotePermission\Dependency\Client\ErpDeliveryNotePermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): ErpDeliveryNotePermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(ErpDeliveryNotePermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
