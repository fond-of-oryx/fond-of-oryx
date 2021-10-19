<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepository getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUserAction(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        return $this->getRepository()->searchCompanyUser($companyUserListTransfer);
    }
}
