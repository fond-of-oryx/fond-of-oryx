<?php

namespace FondOfOryx\Zed\CompanySearchRestApi;

use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanySearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getFulltextSearchFields(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
            CompanySearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT
        );
    }

    /**
     * @return string[]
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::SORT_FIELDS,
            CompanySearchRestApiConstants::SORT_FIELDS_DEFAULT
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanySearchRestApiConstants::ITEMS_PER_PAGE,
            CompanySearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT
        );
    }

    /**
     * @return int[]
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanySearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT
        );
    }
}
