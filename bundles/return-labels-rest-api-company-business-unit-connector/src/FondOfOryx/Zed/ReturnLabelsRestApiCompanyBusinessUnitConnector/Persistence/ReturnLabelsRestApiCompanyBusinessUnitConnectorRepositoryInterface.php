<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface ReturnLabelsRestApiCompanyBusinessUnitConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByIdCustomer(int $idCustomer): ?CompanyBusinessUnitTransfer;
}
