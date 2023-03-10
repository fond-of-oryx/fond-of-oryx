<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorBusinessFactory getFactory()
 */
class CompanyDeleterErpDeliveryNoteConnectorFacade extends AbstractFacade implements CompanyDeleterErpDeliveryNoteConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpDeliveryNoteDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createErpDeliveryNoteDeleter()->deleteErpDeliveryNoteDataForCompanyByIdCompany($companyTransfer);
    }
}
