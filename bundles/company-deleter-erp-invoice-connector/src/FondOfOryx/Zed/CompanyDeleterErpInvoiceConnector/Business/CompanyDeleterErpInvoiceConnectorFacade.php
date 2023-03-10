<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\CompanyDeleterErpInvoiceConnectorBusinessFactory getFactory()
 */
class CompanyDeleterErpInvoiceConnectorFacade extends AbstractFacade implements CompanyDeleterErpInvoiceConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createErpInvoiceDeleter()->deleteErpInvoiceDataForCompanyByIdCompany($companyTransfer);
    }
}
