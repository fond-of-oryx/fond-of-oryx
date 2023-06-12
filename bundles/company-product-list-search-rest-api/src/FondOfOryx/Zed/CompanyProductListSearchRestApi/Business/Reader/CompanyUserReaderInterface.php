<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader;

interface CompanyUserReaderInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return int|null
     */
    public function getIdByFilterFields(array $filterFieldTransfers): ?int;
}
