<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi;

use Generated\Shared\Transfer\CompanyUserListTransfer;

interface CompanyUserSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer;
}
