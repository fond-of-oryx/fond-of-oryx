<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Communication\Plugin;

use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\CompanyDeleterCompanyUnitAddressConnectorFacadeInterface getFacade()
 */
class CompanyUnitAddressDeleterPrePlugin extends AbstractPlugin implements CompanyDeleterPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function execute(CompanyTransfer $companyTransfer): void
    {
        $this->getFacade()->deleteCompanyUnitAddressDataForCompanyById($companyTransfer);
    }
}
