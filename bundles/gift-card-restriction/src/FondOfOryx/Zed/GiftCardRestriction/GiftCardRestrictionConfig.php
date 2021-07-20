<?php

namespace FondOfOryx\Zed\GiftCardRestriction;

use FondOfOryx\Shared\GiftCardRestriction\GiftCardRestrictionConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardRestrictionConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getBlacklistedCountries(): array
    {
        return $this->get(
            GiftCardRestrictionConstants::BLACKLISTED_COUNTRIES,
            GiftCardRestrictionConstants::BLACKLISTED_COUNTRIES_VALUE
        );
    }
}
