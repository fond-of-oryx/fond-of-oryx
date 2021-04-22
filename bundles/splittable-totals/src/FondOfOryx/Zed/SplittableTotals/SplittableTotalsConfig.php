<?php

namespace FondOfOryx\Zed\SplittableTotals;

use FondOfOryx\Shared\SplittableTotals\SplittableTotalsConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SplittableTotalsConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getSplitItemAttribute(): ?string
    {
        $splitItemAttribute = $this->get(
            SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE,
            SplittableTotalsConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT
        );

        if ($splitItemAttribute === '') {
            return null;
        }

        return $splitItemAttribute;
    }
}
