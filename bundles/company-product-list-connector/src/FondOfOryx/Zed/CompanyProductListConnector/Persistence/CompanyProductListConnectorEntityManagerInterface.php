<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Persistence;

interface CompanyProductListConnectorEntityManagerInterface
{
    /**
     * @param array<int> $productListIds
     * @param int $idCompany
     *
     * @return void
     */
    public function assignProductListsToCompany(array $productListIds, int $idCompany): void;

    /**
     * @param array<int> $productListIds
     * @param int $idCompany
     *
     * @return void
     */
    public function deAssignProductListsFromCompany(array $productListIds, int $idCompany): void;
}
