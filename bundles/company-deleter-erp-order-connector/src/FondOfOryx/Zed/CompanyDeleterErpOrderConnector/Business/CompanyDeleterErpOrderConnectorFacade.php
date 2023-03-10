<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\CompanyDeleterErpOrderConnectorBusinessFactory getFactory()
 */
class CompanyDeleterErpOrderConnectorFacade extends AbstractFacade implements CompanyDeleterErpOrderConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteErpOrderDataForCompanyById(CompanyTransfer $companyTransfer): void
    {
        $this->getFactory()->createErpOrderDeleter()->deleteErpOrderDataForCompanyByIdCompany($companyTransfer);
    }
}