<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\CompanyDeleterCompanyUserConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyUserConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyUserConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createCompanyUserDeleter()->deleteCompanyUserDataForCompanyByIdCompany($companyTransfer);
    }
}
