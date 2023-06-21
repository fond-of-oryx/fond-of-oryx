<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer;
}
