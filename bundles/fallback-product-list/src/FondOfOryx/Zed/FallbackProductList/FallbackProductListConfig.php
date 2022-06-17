<?php

namespace FondOfOryx\Zed\FallbackProductList;

use FondOfOryx\Shared\FallbackProductList\FallbackProductListConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class FallbackProductListConfig extends AbstractBundleConfig
{
    /**
     * @return array<int>
     */
    public function getFallbackBlacklistIds(): array
    {
        return $this->get(
            FallbackProductListConstants::FALLBACK_BLACKLIST_IDS,
            FallbackProductListConstants::DEFAULT_FALLBACK_BLACKLIST_IDS,
        );
    }

    /**
     * @return array<int>
     */
    public function getFallbackWhitelistIds(): array
    {
        return $this->get(
            FallbackProductListConstants::FALLBACK_WHITELIST_IDS,
            FallbackProductListConstants::DEFAULT_FALLBACK_WHITELIST_IDS,
        );
    }
}
