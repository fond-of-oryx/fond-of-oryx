<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter;

use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;

class ForeignCustomerReferenceFilter implements ForeignCustomerReferenceFilterInterface
{
    /**
     * @var string|null
     */
    protected static ?string $cachedForeignCustomerReference = null;

 /**
  * @param array $filterFieldTransfers
  *
  * @return string|null
  */
    public function filter(array $filterFieldTransfers): ?string
    {
        if (static::$cachedForeignCustomerReference !== null) {
            // @codeCoverageIgnoreStart
            return static::$cachedForeignCustomerReference;
            // @codeCoverageIgnoreEnd
        }

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== CompanyTypeProductListSearchRestApiConstants::FILTER_FIELD_TYPE_FOREIGN_CUSTOMER_REFERENCE) {
                continue;
            }

            static::$cachedForeignCustomerReference = $filterFieldTransfer->getValue();

            break;
        }

        return static::$cachedForeignCustomerReference;
    }
}
