<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

interface ForeignCustomerReferenceFilterInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return string|null
     */
    public function filter(array $filterFieldTransfers): ?string;
}
