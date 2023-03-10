<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyBusinessUnitConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyBusinessUnitByIdCompany(CompanyTransfer $companyTransfer): void;
}
