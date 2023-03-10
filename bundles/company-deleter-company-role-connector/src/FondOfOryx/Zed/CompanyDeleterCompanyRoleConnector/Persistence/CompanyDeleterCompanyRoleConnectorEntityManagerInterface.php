<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyRoleConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyRolesByIdCompany(CompanyTransfer $companyTransfer): void;
}
