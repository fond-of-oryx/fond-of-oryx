<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompaniesAction(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer
    {
        return $this->getFacade()->deleteCompanies($companyCollectionTransfer);
    }
}
