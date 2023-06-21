<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter;

use FondOfOryx\Shared\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiConstants;

class CompanyUuidFilter implements CompanyUuidFilterInterface
{
    /**
     * @var string|null
     */
    protected static ?string $cachedCompanyUuid = null;

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return string|null
     */
    public function filter(array $filterFieldTransfers): ?string
    {
        if (static::$cachedCompanyUuid !== null) {
            // @codeCoverageIgnoreStart
            return static::$cachedCompanyUuid;
            // @codeCoverageIgnoreEnd
        }

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if ($filterFieldTransfer->getType() !== CompanyProductListSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID) {
                continue;
            }

            static::$cachedCompanyUuid = $filterFieldTransfer->getValue();

            break;
        }

        return static::$cachedCompanyUuid;
    }
}
