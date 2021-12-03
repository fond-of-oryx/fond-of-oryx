<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Persistence;

interface CompanyProductListConnectorRepositoryInterface
{
    /**
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCompany(int $idCompany): array;
}
