<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyUserDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUserDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
