<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiRepository getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRolesAction(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer
    {
        return $this->getRepository()->searchCompanyRoles($companyRoleListTransfer);
    }
}
