<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterProductListConnectorFacadeInterface
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
