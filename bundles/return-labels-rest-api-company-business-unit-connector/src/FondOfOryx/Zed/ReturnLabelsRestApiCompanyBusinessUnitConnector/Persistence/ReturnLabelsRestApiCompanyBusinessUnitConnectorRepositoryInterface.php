<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface ReturnLabelsRestApiCompanyBusinessUnitConnectorRepositoryInterface
{
    /**
     * @param string $companyUserReference
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByCompanyUserReferenceAndIdCustomer(
        string $companyUserReference,
        int $idCustomer
    ): ?CompanyBusinessUnitTransfer;
}
