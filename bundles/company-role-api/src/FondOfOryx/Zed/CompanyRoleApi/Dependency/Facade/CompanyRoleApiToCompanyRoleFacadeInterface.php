<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyRoleTransfer;

interface CompanyRoleApiToCompanyRoleFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    public function getCompanyRoleById(CompanyRoleTransfer $companyRoleTransfer): CompanyRoleTransfer;
}
