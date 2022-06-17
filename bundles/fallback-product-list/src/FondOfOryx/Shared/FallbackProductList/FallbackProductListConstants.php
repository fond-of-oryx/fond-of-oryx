<?php

namespace FondOfOryx\Shared\FallbackProductList;

interface FallbackProductListConstants
{
    /**
     * @var string
     */
    public const FALLBACK_BLACKLIST_IDS = 'FOND_OF_ORYX:FALLBACK_PRODUCT_LIST:FALLBACK_BLACKLIST_IDS';

    /**
     * @var array<int>
     */
    public const DEFAULT_FALLBACK_BLACKLIST_IDS = [];

    /**
     * @var string
     */
    public const FALLBACK_WHITELIST_IDS = 'FOND_OF_ORYX:FALLBACK_PRODUCT_LIST:FALLBACK_WHITELIST_IDS';

    /**
     * @var array<int>
     */
    public const DEFAULT_FALLBACK_WHITELIST_IDS = [];
}
