<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyRoleDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyRoleDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
