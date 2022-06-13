<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader;

interface CompanyBusinessUnitReaderInterface
{
    /**
     * @param array $filterFieldTransfers
     *
     * @return int|null
     */
    public function getIdByFilterFields(array $filterFieldTransfers): ?int;
}
