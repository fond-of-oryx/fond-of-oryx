<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyRoleResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

interface CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleResponseTransfer
     */
    public function findCompanyRoleByUuid(CompanyRoleTransfer $companyRoleTransfer): CompanyRoleResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return void
     */
    public function saveCompanyUser(CompanyUserTransfer $companyUserTransfer): void;
}
