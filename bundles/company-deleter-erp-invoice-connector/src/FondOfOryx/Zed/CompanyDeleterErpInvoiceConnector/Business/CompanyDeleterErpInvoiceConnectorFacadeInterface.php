<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpInvoiceConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteErpInvoiceDataForCompanyById(CompanyTransfer $companyTransfer): void;
}