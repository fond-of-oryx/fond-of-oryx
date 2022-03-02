<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface
{
    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByCompanyUserReference(
        string $companyUserReference
    ): ?CompanyBusinessUnitTransfer;
}
