<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business\Model;

use Generated\Shared\Transfer\CompanyTransfer;

interface ErpInvoiceDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
