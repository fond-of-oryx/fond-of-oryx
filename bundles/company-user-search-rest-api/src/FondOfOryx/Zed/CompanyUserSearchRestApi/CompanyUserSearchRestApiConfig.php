<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi;

use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CompanyUserSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyUserSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyUserSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING,
            CompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getSortFieldMapping(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::SORT_FIELD_MAPPING,
            CompanyUserSearchRestApiConstants::SORT_FIELD_MAPPING_DEFAULT,
        );
    }
}
