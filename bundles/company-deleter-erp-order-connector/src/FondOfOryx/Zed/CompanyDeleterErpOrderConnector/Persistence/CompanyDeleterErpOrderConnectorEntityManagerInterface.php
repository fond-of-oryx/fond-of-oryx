<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpOrderConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteErpOrderByIdCompany(CompanyTransfer $companyTransfer): void;
}
