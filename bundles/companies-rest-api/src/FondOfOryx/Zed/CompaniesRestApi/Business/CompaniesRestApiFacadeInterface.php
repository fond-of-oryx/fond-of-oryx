<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompaniesRestApiFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer;
}
