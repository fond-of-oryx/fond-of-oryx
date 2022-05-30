<?php

namespace FondOfOryx\Zed\CartSearchRestApi;

use FondOfSpryker\Shared\PriceList\PriceListConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string, string>
     */
    public function getFilterFieldTypeMapping(): array
    {
        return $this->get(
            PriceListConstants::FILTER_FIELD_TYPE_MAPPING,
            PriceListConstants::FILTER_FIELD_TYPE_MAPPING_DEFAULT,
        );
    }
}
