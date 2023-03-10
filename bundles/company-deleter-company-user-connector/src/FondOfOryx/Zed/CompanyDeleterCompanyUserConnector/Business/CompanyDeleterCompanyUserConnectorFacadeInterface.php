<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUserConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteCompanyUserDataForCompanyById(CompanyTransfer $companyTransfer): void;
}