<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi;

use FondOfOryx\Shared\CompanyTypeProductListsRestApi\CompanyTypeProductListsRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CompanyTypeProductListsRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getIdCompanyTypeForManufacturer(): int
    {
        return $this->get(
            CompanyTypeProductListsRestApiConstants::ID_COMPANY_TYPE_FOR_MANUFACTURER,
            CompanyTypeProductListsRestApiConstants::ID_COMPANY_TYPE_FOR_MANUFACTURER_DEFAULT,
        );
    }
}
