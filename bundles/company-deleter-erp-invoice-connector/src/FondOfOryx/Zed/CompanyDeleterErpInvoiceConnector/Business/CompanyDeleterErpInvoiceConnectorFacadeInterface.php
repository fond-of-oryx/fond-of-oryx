<?php

namespace FondOfOryx\Zed\CompanyDeleterErpInvoiceConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpInvoiceConnectorFacadeInterface
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
