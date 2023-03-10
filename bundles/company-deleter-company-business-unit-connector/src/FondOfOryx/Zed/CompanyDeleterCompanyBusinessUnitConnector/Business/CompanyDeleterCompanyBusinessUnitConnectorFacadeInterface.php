<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyBusinessUnitConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyBusinessUnitConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteErpInvoiceDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
