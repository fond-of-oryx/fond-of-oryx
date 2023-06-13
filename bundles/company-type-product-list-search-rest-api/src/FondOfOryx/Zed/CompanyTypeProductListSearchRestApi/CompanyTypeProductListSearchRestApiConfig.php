<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi;

use FondOfOryx\Shared\CompanyTypeProductListSearchRestApi\CompanyTypeProductListSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CompanyTypeProductListSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getCompanyTypeNameForManufacturer(): string
    {
        return $this->get(
            CompanyTypeProductListSearchRestApiConstants::COMPANY_TYPE_NAME_FOR_MANUFACTURER,
            CompanyTypeProductListSearchRestApiConstants::COMPANY_TYPE_NAME_FOR_MANUFACTURER_DEFAULT,
        );
    }
}
