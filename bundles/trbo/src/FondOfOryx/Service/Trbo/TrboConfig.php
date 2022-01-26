<?php

namespace FondOfOryx\Service\Trbo;

use FondOfOryx\Shared\Trbo\TrboConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

class TrboConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getTrboApiShopId(): string
    {
        return $this->get(TrboConstants::TRBO_API_SHOP_ID, '');
    }

    /**
     * @return string
     */
    public function getTrboApiClientId(): string
    {
        return $this->get(TrboConstants::TRBO_API_CLIENT_ID, '');
    }

    /**
     * @return string
     */
    public function getTrboApiKey(): string
    {
        return $this->get(TrboConstants::TRBO_API_KEY, '');
    }

    /**
     * @return string
     */
    public function getTrboApiUrl(): string
    {
        return $this->get(TrboConstants::TRBO_API_URL, '');
    }

    /**
     * @return string
     */
    public function getTrboApiTimeout(): string
    {
        return $this->get(TrboConstants::TRBO_API_TIMEOUT, TrboConstants::TRBO_API_FALLBACK_TIMEOUT);
    }

    /**
     * @return bool
     */
    public function isHttpErrorsEnabled(): bool
    {
        return $this->get(TrboConstants::TRBO_API_HTTP_ERRORS, false);
    }
}
