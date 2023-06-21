<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter;

interface IdCustomerFilterInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return int|null
     */
    public function filter(array $filterFieldTransfers): ?int;
}
