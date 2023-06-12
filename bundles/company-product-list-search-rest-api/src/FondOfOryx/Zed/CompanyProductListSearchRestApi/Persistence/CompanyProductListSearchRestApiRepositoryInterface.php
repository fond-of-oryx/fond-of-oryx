<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence;

interface CompanyProductListSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $companyUuid
     *
     * @return int|null
     */
    public function getIdCompanyUserByIdCustomerAndCompanyUuid(int $idCustomer, string $companyUuid): ?int;
}
