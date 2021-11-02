<?php

namespace FondOfOryx\Shared\ProductLocaleRestrictionStorage;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class ProductLocaleRestrictionStorageConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME = 'product_abstract_locale_restriction';

    /**
     * @var string
     */
    public const PRODUCT_ABSTRACT_LOCALE_RESTRICTION_SYNC_STORAGE_QUEUE = 'sync.storage.product';
}
