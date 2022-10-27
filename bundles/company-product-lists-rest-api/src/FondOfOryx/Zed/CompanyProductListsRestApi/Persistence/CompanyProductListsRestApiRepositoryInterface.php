<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Persistence;

interface CompanyProductListsRestApiRepositoryInterface
{
    /**
     * @param array<string> $companyUuids
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getCompanyIdsByCompanyUuidsAndIdCustomer(
        array $companyUuids,
        int $idCustomer
    ): array;

    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getCompanyIdsByIdProductList(int $idProductList): array;
}
