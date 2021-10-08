<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepository getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompaniesAction(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        return $this->getRepository()->searchCompanies($companyListTransfer);
    }
}
