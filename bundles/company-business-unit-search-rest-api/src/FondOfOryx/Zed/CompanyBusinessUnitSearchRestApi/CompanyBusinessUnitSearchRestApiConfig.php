<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi;

use FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::SORT_FIELDS,
            CompanyBusinessUnitSearchRestApiConstants::SORT_FIELDS_DEFAULT
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyBusinessUnitSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT
        );
    }

    /**
     * @return int[]
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyBusinessUnitSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyBusinessUnitSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT
        );
    }
}
