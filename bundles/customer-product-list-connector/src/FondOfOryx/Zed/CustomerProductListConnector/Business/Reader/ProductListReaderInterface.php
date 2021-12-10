<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Reader;

interface ProductListReaderInterface
{
    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getIdsByIdCustomer(int $idCustomer): array;
}
