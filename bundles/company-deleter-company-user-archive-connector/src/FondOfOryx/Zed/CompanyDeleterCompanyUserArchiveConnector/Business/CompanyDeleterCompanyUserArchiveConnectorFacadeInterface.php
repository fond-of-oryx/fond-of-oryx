<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyUserArchiveConnector\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyDeleterCompanyUserArchiveConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function deleteCompanyUserArchiveDataForCompanyByIdCompany(CompanyTransfer $companyTransfer): void;
}
