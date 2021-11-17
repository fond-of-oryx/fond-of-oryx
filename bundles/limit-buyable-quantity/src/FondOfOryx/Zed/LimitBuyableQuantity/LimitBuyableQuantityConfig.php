<?php

namespace FondOfOryx\Zed\LimitBuyableQuantity;

use FondOfOryx\Shared\LimitBuyableQuantity\LimitBuyableQuantityConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class LimitBuyableQuantityConfig extends AbstractBundleConfig
{
    /**
     * @return int|null
     */
    public function getMaxQuantity(): ?int
    {
        $maxQuantity = $this->get(
            LimitBuyableQuantityConstants::MAX_QUANTITY,
            LimitBuyableQuantityConstants::MAX_QUANTITY_DEFAULT,
        );

        if ($maxQuantity <= 0) {
            return null;
        }

        return $maxQuantity;
    }
}
