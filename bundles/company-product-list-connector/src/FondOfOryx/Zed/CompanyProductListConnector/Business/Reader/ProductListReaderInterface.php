<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Reader;

interface ProductListReaderInterface
{
    /**
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getIdsByIdCompany(int $idCompany): array;
}
