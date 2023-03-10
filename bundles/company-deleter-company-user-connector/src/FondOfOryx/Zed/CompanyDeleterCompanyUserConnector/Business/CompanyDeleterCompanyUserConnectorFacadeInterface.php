<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUserConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteCompanyUserDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
