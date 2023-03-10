<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterProductListConnector\Business\CompanyDeleterProductListConnectorBusinessFactory getFactory()
 */
class CompanyDeleterProductListConnectorFacade extends AbstractFacade implements CompanyDeleterProductListConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteProductListDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createCompanyToProductListDeleter()->deleteProductListDataForCompanyByIdCompany($companyTransfer);
    }
}
