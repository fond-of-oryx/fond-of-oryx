<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleter;
use FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence\CompanyDeleterErpInvoiceConnectorEntityManagerInterface getEntityManager()
 */
class CompanyDeleterErpInvoiceConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model\ErpInvoiceDeleterInterface
     */
    public function createErpInvoiceDeleter(): ErpInvoiceDeleterInterface
    {
        return new ErpInvoiceDeleter($this->getEntityManager());
    }
}
