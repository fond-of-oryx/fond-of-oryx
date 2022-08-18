<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList;

use FondOfOryx\Shared\VertigoPriceProductPriceList\VertigoPriceProductPriceListConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class VertigoPriceProductPriceListConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getHttpClientConfig(): array
    {
        return $this->get(VertigoPriceProductPriceListConstants::HTTP_CLIENT_CONFIG, []);
    }
}
