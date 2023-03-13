<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterProductListConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyProductListRelationsByIdCompany(CompanyTransfer $companyTransfer): void;
}
