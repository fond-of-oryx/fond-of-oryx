<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Persistence;

interface CustomerProductListConnectorEntityManagerInterface
{
    /**
     * @param array<int> $productListIds
     * @param int $idCustomer
     *
     * @return void
     */
    public function assignProductListsToCustomer(array $productListIds, int $idCustomer): void;

    /**
     * @param array<int> $productListIds
     * @param int $idCustomer
     *
     * @return void
     */
    public function deAssignProductListsFromCustomer(array $productListIds, int $idCustomer): void;
}
