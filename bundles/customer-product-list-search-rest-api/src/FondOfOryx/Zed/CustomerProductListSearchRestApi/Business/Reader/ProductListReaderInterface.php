<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader;

interface ProductListReaderInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return array<int>
     */
    public function getIdsByFilterFields(array $filterFieldTransfers): array;
}
