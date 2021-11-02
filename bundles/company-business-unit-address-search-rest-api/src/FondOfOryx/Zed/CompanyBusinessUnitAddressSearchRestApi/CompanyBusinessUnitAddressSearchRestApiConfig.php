<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi;

use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyBusinessUnitAddressSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::SORT_FIELDS,
            CompanyBusinessUnitAddressSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyBusinessUnitAddressSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyBusinessUnitAddressSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyBusinessUnitAddressSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }
}
