<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence;

interface CompanyBusinessUnitCartSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyBusinessUnitUuid
     *
     * @return int|null
     */
    public function getIdCompanyBusinessUnitByIdCustomerAndCompanyBusinessUnitUuid(
        int $idCustomer,
        string $companyBusinessUnitUuid
    ): ?int;

    /**
     * @param string $key
     *
     * @return int|null
     */
    public function getIdPermissionByKey(string $key): ?int;
}
