<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Communication\Plugin;

use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\CompanyDeleterErpInvoiceConnectorFacadeInterface getFacade()
 */
class ErpInvoiceDeleterPrePlugin extends AbstractPlugin implements CompanyDeleterPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function execute(CompanyTransfer $companyTransfer): void
    {
        $this->getFacade()->deleteErpInvoiceDataForCompanyById($companyTransfer);
    }
}
