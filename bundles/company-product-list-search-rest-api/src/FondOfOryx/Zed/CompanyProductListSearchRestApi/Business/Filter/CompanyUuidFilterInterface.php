<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter;

interface CompanyUuidFilterInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return string|null
     */
    public function filter(array $filterFieldTransfers): ?string;
}
