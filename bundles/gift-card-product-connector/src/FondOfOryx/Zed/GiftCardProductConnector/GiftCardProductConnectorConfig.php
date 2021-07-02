<?php

namespace FondOfOryx\Zed\GiftCardProductConnector;

use FondOfOryx\Shared\GiftCardProductConnector\GiftCardProductConnectorConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class GiftCardProductConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getGiftCardProductSkuPrefixes(): array
    {
        return $this->get(GiftCardProductConnectorConstants::PRODUCT_SKU_PREFIXES, []);
    }

    /**
     * @return string
     */
    public function getGiftCardPattern(): string
    {
        return $this->get(GiftCardProductConnectorConstants::PATTERN, []);
    }
}
