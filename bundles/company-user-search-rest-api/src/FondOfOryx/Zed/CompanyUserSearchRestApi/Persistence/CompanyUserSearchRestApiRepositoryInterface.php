<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUserListTransfer;

interface CompanyUserSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer;
}
