<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface ErpOrderDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpOrderDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}