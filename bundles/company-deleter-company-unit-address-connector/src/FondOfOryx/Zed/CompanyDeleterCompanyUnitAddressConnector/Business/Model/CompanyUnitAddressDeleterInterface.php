<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyUnitAddressDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUnitAddressDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
