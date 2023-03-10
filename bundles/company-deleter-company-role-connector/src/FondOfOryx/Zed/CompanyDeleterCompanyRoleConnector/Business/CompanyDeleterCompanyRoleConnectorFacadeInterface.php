<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyRoleConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyRoleConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteCompanyRoleDataForCompanyById(CompanyTransfer $companyTransfer): void;
}
