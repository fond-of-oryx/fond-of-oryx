<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi\Zed;

use Generated\Shared\Transfer\CompanyRoleListTransfer;

interface CompanyRoleSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer;
}
