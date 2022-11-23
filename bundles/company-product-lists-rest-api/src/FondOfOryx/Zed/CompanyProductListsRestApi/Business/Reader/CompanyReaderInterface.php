<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader;

interface CompanyReaderInterface
{
    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getIdsByIdProductList(int $idProductList): array;
}
