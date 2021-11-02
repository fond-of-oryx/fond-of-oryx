<?php

namespace FondOfOryx\Zed\SplittableQuote;

use FondOfOryx\Shared\SplittableQuote\SplittableQuoteConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SplittableQuoteConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getSplitItemAttribute(): ?string
    {
        $splitItemAttribute = $this->get(
            SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE,
            SplittableQuoteConstants::SPLIT_ITEM_ATTRIBUTE_DEFAULT,
        );

        if ($splitItemAttribute === '') {
            return null;
        }

        return $splitItemAttribute;
    }
}
