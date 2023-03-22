<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUnitAddressConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function deleteCompanyUnitAddressByIdCompany(CompanyTransfer $companyTransfer): void;
}
