<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;

interface ReturnLabelsRestApiCompanyConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByIdCustomer(int $idCustomer): ?CompanyTransfer;
}
