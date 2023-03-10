<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpInvoiceConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpInvoiceByIdCompany(CompanyTransfer $companyTransfer): void;
}
