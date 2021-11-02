<?php

namespace FondOfOryx\Zed\GiftCardExpiration;

use FondOfOryx\Shared\GiftCardExpiration\GiftCardExpirationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardExpirationConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getExpirationPeriod(): int
    {
        return $this->get(
            GiftCardExpirationConstants::EXPIRATION_PERIOD,
            GiftCardExpirationConstants::EXPIRATION_PERIOD_DEFAULT,
        );
    }
}
