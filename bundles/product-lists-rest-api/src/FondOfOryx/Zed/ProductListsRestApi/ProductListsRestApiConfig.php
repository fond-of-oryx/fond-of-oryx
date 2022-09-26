<?php

namespace FondOfOryx\Zed\ProductListsRestApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class ProductListsRestApiConfig extends AbstractBundleConfig
{
    /**
     * @return array<string>
     */
    public function getAllowedFieldsToPatch(): array
    {
        return [];
    }
}
