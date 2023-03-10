<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Communication\Plugin;

use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\CompanyDeleterCompanyUserConnectorFacadeInterface getFacade()
 */
class CompanyUserDeleterPrePlugin extends AbstractPlugin implements CompanyDeleterPreDeletePluginInterface
{
    public function execute(CompanyTransfer $companyTransfer): void
    {
        $this->getFacade()->deleteCompanyUserDataForCompanyById($companyTransfer);
    }

}