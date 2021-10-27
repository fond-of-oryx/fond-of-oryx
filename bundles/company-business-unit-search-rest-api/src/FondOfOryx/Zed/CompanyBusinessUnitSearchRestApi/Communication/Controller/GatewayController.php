<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence\CompanyBusinessUnitSearchRestApiRepository getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnitAction(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer
    {
        return $this->getRepository()->searchCompanyBusinessUnit($companyBusinessUnitListTransfer);
    }
}
