<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

interface IdCustomerFilterInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return int|null
     */
    public function filter(array $filterFieldTransfers): ?int;
}
