<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence;

interface CustomerProductListSearchRestApiRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCustomer(int $idCustomer): array;
}
