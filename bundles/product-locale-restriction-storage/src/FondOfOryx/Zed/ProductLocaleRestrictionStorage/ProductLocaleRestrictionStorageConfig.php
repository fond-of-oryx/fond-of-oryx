<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class ProductLocaleRestrictionStorageConfig extends AbstractBundleConfig
{
    /**
     * @deprecated Use {@link \Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()} instead.
     *
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getProductAbstractLocaleRestrictionSynchronizationPoolName(): ?string
    {
        return null;
    }

    /**
     * @return string|null
     */
    public function getProductAbstractLocaleRestrictionEventQueueName(): ?string
    {
        return null;
    }
}
