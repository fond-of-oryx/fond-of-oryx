<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use Generated\Shared\Transfer\FilterFieldTransfer;

interface CompanyBusinessUnitUuidFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return string|null
     */
    public function filterByFilterField(FilterFieldTransfer $filterFieldTransfer): ?string;
}
