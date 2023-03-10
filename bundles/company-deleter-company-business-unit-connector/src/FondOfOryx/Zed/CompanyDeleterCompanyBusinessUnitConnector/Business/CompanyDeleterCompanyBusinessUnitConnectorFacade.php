<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyBusinessUnitConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyBusinessUnitConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createBusinessUnitDeleter()->deleteBusinessUnitDataForCompanyByIdCompany($companyTransfer);
    }
}
