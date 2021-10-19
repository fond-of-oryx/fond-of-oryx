<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi;

use FondOfOryx\Shared\CompanyUserSearchRestApi\CompanyUserSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyUserSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getFulltextSearchFields(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
            CompanyUserSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT
        );
    }

    /**
     * @return string[]
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::SORT_FIELDS,
            CompanyUserSearchRestApiConstants::SORT_FIELDS_DEFAULT
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyUserSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT
        );
    }

    /**
     * @return int[]
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyUserSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyUserSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT
        );
    }
}
