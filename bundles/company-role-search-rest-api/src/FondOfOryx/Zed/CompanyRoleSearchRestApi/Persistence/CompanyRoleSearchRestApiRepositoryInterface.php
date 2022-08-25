<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence;

use Generated\Shared\Transfer\CompanyRoleListTransfer;

interface CompanyRoleSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return int|null
     */
    public function getIdCompanyUserByCompanyRoleList(CompanyRoleListTransfer $companyRoleListTransfer): ?int;
}
