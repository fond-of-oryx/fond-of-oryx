<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUnitAddressConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUnitAddressConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteCompanyUnitAddressDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
