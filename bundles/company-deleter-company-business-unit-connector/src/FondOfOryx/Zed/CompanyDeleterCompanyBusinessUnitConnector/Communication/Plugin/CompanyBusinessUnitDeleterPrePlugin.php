<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Communication\Plugin;

use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\CompanyDeleterCompanyBusinessUnitConnectorFacadeInterface getFacade()
 */
class CompanyBusinessUnitDeleterPrePlugin extends AbstractPlugin implements CompanyDeleterPreDeletePluginInterface
{
    public function execute(CompanyTransfer $companyTransfer): void
    {
        $this->getFacade()->deleteErpInvoiceDataForCompanyById($companyTransfer);
    }

}