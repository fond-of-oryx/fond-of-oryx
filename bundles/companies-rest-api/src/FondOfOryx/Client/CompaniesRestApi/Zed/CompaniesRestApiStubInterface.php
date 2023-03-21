<?php

namespace FondOfOryx\Client\CompaniesRestApi\Zed;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompaniesRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer;
}
