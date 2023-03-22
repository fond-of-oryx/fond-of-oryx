<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\CompanyDeleterCompanyUserArchiveConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyUserArchiveConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyUserArchiveConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserArchiveDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createCompanyUserArchiveDeleter()->deleteCompanyUserArchiveDataForCompanyByIdCompany($companyTransfer);
    }
}
