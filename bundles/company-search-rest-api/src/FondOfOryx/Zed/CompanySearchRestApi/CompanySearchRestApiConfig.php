<?php

namespace FondOfOryx\Zed\CompanySearchRestApi;

use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CompanySearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanySearchRestApiConstants::ITEMS_PER_PAGE,
            CompanySearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING,
            CompanySearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getSortFieldMapping(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::SORT_FIELD_MAPPING,
            CompanySearchRestApiConstants::SORT_FIELD_MAPPING_DEFAULT,
        );
    }
}
