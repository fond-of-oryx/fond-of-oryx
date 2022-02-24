<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTransfer;

interface JellyfishSalesOrderCompanyToCompanyUserReferenceFacadeInterface
{
    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByCompanyUserReference(
        string $companyUserReference
    ): ?CompanyTransfer;
}
