<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyToProductListConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyProductListRelationsByIdCompany(CompanyTransfer $companyTransfer): void;
}
