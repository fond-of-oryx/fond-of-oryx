<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Communication\Plugin;

use FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorFacadeInterface getFacade()
 */
class ErpDeliveryNoteDeleterPrePlugin extends AbstractPlugin implements CompanyDeleterPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function execute(CompanyTransfer $companyTransfer): void
    {
        $this->getFacade()->deleteErpDeliveryNoteDataForCompanyById($companyTransfer);
    }
}
