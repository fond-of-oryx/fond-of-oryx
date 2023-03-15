<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUserArchiveConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserArchiveByIdCompany(CompanyTransfer $companyTransfer): void;
}
