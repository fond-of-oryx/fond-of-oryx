<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;

class IdCustomerFilter implements IdCustomerFilterInterface
{
    /**
     * @var int|null
     */
    protected static ?int $cachedIdCustomer = null;

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return int|null
     */
    public function filter(array $filterFieldTransfers): ?int
    {
        if (static::$cachedIdCustomer !== null) {
            // @codeCoverageIgnoreStart
            return static::$cachedIdCustomer;
            // @codeCoverageIgnoreEnd
        }

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== CompanyTypeProductListSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER) {
                continue;
            }

            static::$cachedIdCustomer = (int)$filterFieldTransfer->getValue();

            break;
        }

        return static::$cachedIdCustomer;
    }
}
