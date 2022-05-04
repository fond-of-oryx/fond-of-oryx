<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

interface CompanyUserCompanyRoleWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function saveCompanyUserCompanyRole(
        CompanyUserTransfer $companyUserTransfer,
        RestCompanyUsersRequestAttributesTransfer $companyUsersRequestAttributesTransfer
    ): CompanyUserTransfer;
}
