<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpOrderConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteErpOrderDataForCompanyById(CompanyTransfer $companyTransfer): void;
}