<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface ReturnLabelsRestApiCompanyConnectorRepositoryInterface
{
    /**
     * @param string $companyUserReference
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByCompanyUserReferenceAndIdCustomer(
        string $companyUserReference,
        int $idCustomer
    ): ?CompanyTransfer;
}
