<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business\CompanyDeleterCompanyToProductListConnectorBusinessFactory getFactory()
 */
class CompanyDeleterCompanyToProductListConnectorFacade extends AbstractFacade implements CompanyDeleterCompanyToProductListConnectorFacadeInterface
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
