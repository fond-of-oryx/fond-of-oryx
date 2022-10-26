<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Persistence;

interface CustomerProductListsRestApiEntityManagerInterface
{
    /**
     * @param array $customerIdsToAssign
     * @param int $idProductList
     *
     * @return void
     */
    public function assignCustomersToProductList(array $customerIdsToAssign, int $idProductList): void;

    /**
     * @param array $customerIdsToDeassign
     * @param int $idProductList
     *
     * @return void
     */
    public function deassignCustomersFromProductList(array $customerIdsToDeassign, int $idProductList): void;
}
