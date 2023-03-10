<?php

namespace FondOfOryx\Zed\CompanyDeleterErpOrderConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterErpOrderConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteErpOrderDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
