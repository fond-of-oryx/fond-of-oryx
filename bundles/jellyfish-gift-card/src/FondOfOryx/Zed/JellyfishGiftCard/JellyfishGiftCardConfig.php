<?php

namespace FondOfOryx\Zed\JellyfishGiftCard;

use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishGiftCardConfig extends AbstractBundleConfig
{
    /**
     * @return array
     */
    public function getHttpClientConfig(): array
    {
        return $this->get(JellyfishGiftCardConstants::HTTP_CLIENT_CONFIG, []);
    }

    /**
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->get(JellyfishGiftCardConstants::SENDER_NAME, '');
    }

    /**
     * @return string
     */
    public function getSenderEmail(): string
    {
        return $this->get(JellyfishGiftCardConstants::SENDER_EMAIL, '');
    }

    /**
     * @return string
     */
    public function getFallbackLocaleName(): string
    {
        return $this->get(
            JellyfishGiftCardConstants::FALLBACK_LOCALE_NAME,
            JellyfishGiftCardConstants::FALLBACK_LOCALE_NAME_DEFAULT,
        );
    }
}
