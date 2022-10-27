<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Persistence;

interface CompanyProductListsRestApiEntityManagerInterface
{
    /**
     * @param array $companyIdsToAssign
     * @param int $idProductList
     *
     * @return void
     */
    public function assignCompaniesToProductList(array $companyIdsToAssign, int $idProductList): void;

    /**
     * @param array $companyIdsToDeassign
     * @param int $idProductList
     *
     * @return void
     */
    public function deassignCompaniesFromProductList(array $companyIdsToDeassign, int $idProductList): void;
}
