<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyToProductListConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteProductListDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
