<?php

namespace FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;

interface CompanyTypeConverterToCompanyTypeRoleFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return string[]
     */
    public function getPermissionKeysByCompanyTypeAndCompanyRole(
        CompanyTypeTransfer $companyTypeTransfer,
        CompanyRoleTransfer $companyRoleTransfer
    ): array;
}
