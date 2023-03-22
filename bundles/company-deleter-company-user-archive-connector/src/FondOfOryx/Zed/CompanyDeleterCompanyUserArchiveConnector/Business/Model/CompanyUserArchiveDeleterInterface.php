<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyUserArchiveDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserArchiveDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
