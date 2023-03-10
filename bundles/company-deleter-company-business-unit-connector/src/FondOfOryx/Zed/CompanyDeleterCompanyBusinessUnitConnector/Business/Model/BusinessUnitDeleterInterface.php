<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface BusinessUnitDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteBusinessUnitDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
