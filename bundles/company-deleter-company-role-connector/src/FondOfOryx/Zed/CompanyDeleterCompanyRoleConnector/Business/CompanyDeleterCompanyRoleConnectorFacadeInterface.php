<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyRoleConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function deleteCompanyRoleDataForCompanyById(CompanyTransfer $companyTransfer): void;
}