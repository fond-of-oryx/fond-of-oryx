<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteAction(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->getFacade()->deleteCompany($companyTransfer);
    }
}
