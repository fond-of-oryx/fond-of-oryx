<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyUserListTransfer;

interface CompanyUserReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function findByCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer;
}
