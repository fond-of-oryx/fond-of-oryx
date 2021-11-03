<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi;

use Generated\Shared\Transfer\CompanyRoleListTransfer;

interface CompanyRoleSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): CompanyRoleListTransfer;
}
