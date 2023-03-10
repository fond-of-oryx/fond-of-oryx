<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUserConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserByIdCompany(CompanyTransfer $companyTransfer): void;
}
