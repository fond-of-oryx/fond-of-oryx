<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Persistence;

interface CustomerProductListsRestApiRepositoryInterface
{
    /**
     * @param array<string> $customerReferences
     *
     * @return array<int>
     */
    public function getCustomerIdsByCustomerReferences(
        array $customerReferences
    ): array;

    /**
     * @param int $idProductList
     * @param int $idCustomer
     *
     * @return bool
     */
    public function hasProductListByIdProductListAndIdCustomer(int $idProductList, int $idCustomer): bool;

    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getCustomerIdsByIdProductList(int $idProductList): array;
}
