<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi;

use FondOfOryx\Shared\ProductListSearchRestApi\ProductListSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class ProductListSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getFulltextSearchFields(): array
    {
        return $this->get(
            ProductListSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS,
            ProductListSearchRestApiConstants::FULLTEXT_SEARCH_FIELDS_DEFAULT,
        );
    }

    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            ProductListSearchRestApiConstants::SORT_FIELDS,
            ProductListSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            ProductListSearchRestApiConstants::ITEMS_PER_PAGE,
            ProductListSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            ProductListSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            ProductListSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }
}
