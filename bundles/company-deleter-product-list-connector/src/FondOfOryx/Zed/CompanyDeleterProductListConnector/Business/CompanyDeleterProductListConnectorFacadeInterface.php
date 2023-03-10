<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterProductListConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteProductListDataForCompanyById(CompanyTransfer $companyTransfer): void;
}