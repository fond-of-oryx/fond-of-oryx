<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi;

use FondOfOryx\Shared\ProductListSearchRestApi\ProductListSearchRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class ProductListSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_PRODUCT_LIST_SEARCH = 'product-list-search';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_PRODUCT_LIST_SEARCH = 'product-list-search-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_PRODUCT_LIST_IS_NOT_SPECIFIED = '1000';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_PRODUCT_LIST_IS_NOT_SPECIFIED = 'Authorization header is required';

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

    /**
     * @return array<string>
     */
    public function getSortParamNames(): array
    {
        $sortParamNames = [];

        foreach ($this->getSortFields() as $sortField) {
            $sortParamNames[] = sprintf('%s_asc', $sortField);
            $sortParamNames[] = sprintf('%s_desc', $sortField);
        }

        return $sortParamNames;
    }

    /**
     * @return array<string>
     */
    public function getSortParamLocalizedNames(): array
    {
        $sortParamLocalizedNames = [];

        foreach ($this->getSortParamNames() as $sortParamName) {
            $sortParamLocalizedNames[$sortParamName] = sprintf('product_list_search_rest_api.sort.%s', $sortParamName);
        }

        return $sortParamLocalizedNames;
    }
}
