<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader;

interface CustomerReaderInterface
{
    /**
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getIdsByIdProductList(int $idProductList): array;
}
