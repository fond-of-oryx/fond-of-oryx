<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi\Zed;

use Generated\Shared\Transfer\CompanyUserListTransfer;

interface CompanyUserSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer;
}
