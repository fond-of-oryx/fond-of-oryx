<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class IdCustomerFilter implements IdCustomerFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return int|null
     */
    public function filterByFilterField(FilterFieldTransfer $filterFieldTransfer): ?int
    {
        $filterFieldType = $filterFieldTransfer->getType();

        if ($filterFieldType !== CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER) {
            return null;
        }

        return (int)$filterFieldTransfer->getValue();
    }
}
