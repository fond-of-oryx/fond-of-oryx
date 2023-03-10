<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\CompanyDeleterCompanyRoleConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyRoleConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyRoleConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteCompanyRoleDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createCompanyRoleDeleter()->deleteCompanyRoleDataForCompanyByIdCompany($companyTransfer);
    }
}