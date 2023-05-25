<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business;

use Generated\Shared\Transfer\CompanyUserListTransfer;

interface CompanyUserSearchRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds company users by criteria from CompanyUserListTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function findCompanyUsers(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer;
}
