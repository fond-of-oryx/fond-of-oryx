<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository;


use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

interface ReturnLabelsRestApiCompanyBusinessUnitRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByIdCustomer(int $idCustomer): ?CompanyBusinessUnitTransfer;
}
