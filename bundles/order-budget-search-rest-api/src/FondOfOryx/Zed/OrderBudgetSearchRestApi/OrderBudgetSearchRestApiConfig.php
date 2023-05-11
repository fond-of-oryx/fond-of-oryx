<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi;

use FondOfOryx\Shared\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class OrderBudgetSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->get(
            OrderBudgetSearchRestApiConstants::ITEMS_PER_PAGE,
            OrderBudgetSearchRestApiConstants::ITEMS_PER_PAGE_DEFAULT,
        );
    }

    /**
     * @return array<int>
     */
    public function getValidItemsPerPageOptions(): array
    {
        return $this->get(
            OrderBudgetSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS,
            OrderBudgetSearchRestApiConstants::VALID_ITEMS_PER_PAGE_OPTIONS_DEFAULT,
        );
    }

    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING,
            OrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }
}
