<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter;

use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;

class CompanyBusinessUnitUuidFilter implements CompanyBusinessUnitUuidFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterFieldTransfer $filterFieldTransfer
     *
     * @return string|null
     */
    public function filterByFilterField(FilterFieldTransfer $filterFieldTransfer): ?string
    {
        $filterFieldType = $filterFieldTransfer->getType();

        if ($filterFieldType !== CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID) {
            return null;
        }

        return $filterFieldTransfer->getValue();
    }
}
