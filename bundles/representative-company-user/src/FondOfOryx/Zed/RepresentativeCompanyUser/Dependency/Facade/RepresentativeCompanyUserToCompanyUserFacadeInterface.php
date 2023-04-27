<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

interface RepresentativeCompanyUserToCompanyUserFacadeInterface
{
    /**
     * Specification:
     * - Executes CompanyUserSavePreCheckPluginInterface check plugins before company user create.
     * - Creates a company user
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     * @api
     *
     */
    public function create(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer;

    /**
     * Specification:
     * - Executes CompanyUserPreDeletePluginInterface plugins before delete company user.
     * - Deletes a company user.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function deleteCompanyUser(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer;
}