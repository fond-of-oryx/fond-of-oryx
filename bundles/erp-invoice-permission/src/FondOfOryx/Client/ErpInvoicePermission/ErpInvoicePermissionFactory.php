<?php

namespace FondOfOryx\Client\ErpInvoicePermission;

use FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface;
use FondOfOryx\Client\ErpInvoicePermission\Zed\ErpInvoicePermissionStub;
use Spryker\Client\Kernel\AbstractFactory;

class ErpInvoicePermissionFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ErpInvoicePermission\Zed\ErpInvoicePermissionStubInterface
     */
    public function createErpInvoicePermissionStub()
    {
        return new ErpInvoicePermissionStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfOryx\Client\ErpInvoicePermission\Dependency\Client\ErpInvoicePermissionToZedRequestInterface
     */
    protected function getZedRequestClient(): ErpInvoicePermissionToZedRequestInterface
    {
        return $this->getProvidedDependency(ErpInvoicePermissionDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
