<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyUnitAddressConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyUnitAddressConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUnitAddressDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createCompanyUnitAddressDeleter()->deleteCompanyUnitAddressDataForCompanyByIdCompany($companyTransfer);
    }
}
