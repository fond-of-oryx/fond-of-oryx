<?php

namespace FondOfOryx\Zed\CartSearchRestApi;

use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            CartSearchRestApiConstants::ITEMS_PER_PAGE,
            CartSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            CartSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            CartSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            CartSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING,
            CartSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }
}
