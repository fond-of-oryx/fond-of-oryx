<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use Generated\Shared\Transfer\FilterFieldTransfer;

interface IdCustomerFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return int|null
     */
    public function filterByFilterField(FilterFieldTransfer $filterFieldTransfer): ?int;
}
