<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Persistence;

interface CustomerProductListConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCustomer(int $idCustomer): array;
}
