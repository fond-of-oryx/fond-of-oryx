<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use FondOfOryx\Shared\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyRoleSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getFulltextSearchFields(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
            CompanyRoleSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
        );
    }

    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::SORT_FIELDS,
            CompanyRoleSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE,
            CompanyRoleSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CompanyRoleSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }
}
