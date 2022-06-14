<?php

namespace FondOfOryx\Glue\CartSearchRestApi;

use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_CART_SEARCH = 'cart-search';

    /**
     * @var string
     */
    public const RESOURCE_CART_ITEMS = 'items';

    /**
     * @var string
     */
    public const RESOURCE_CARTS = 'carts';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_CART_SEARCH = 'cart-search-resource';

    /**
     * @var string
     */
    public const RESPONSE_CODE_USER_IS_NOT_SPECIFIED = '1000';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_USER_IS_NOT_SPECIFIED = 'Authorization header is required';

    /**
     * @return array<string>
     */
    public function getSortFields(): array
    {
        return $this->get(
            CartSearchRestApiConstants::SORT_FIELDS,
            CartSearchRestApiConstants::SORT_FIELDS_DEFAULT,
        );
    }

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
            $sortParamLocalizedNames[$sortParamName] = sprintf('cart_search_rest_api.sort.%s', $sortParamName);
        }

        return $sortParamLocalizedNames;
    }
}
