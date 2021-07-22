<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleFilter implements LocaleFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig $config
     */
    public function __construct(JellyfishGiftCardConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function fromOrder(OrderTransfer $orderTransfer): LocaleTransfer
    {
        $localeTransfer = $orderTransfer->getLocale();

        if ($localeTransfer !== null && $localeTransfer->getLocaleName() !== null) {
            return $localeTransfer;
        }

        return (new LocaleTransfer())->setLocaleName($this->config->getFallbackLocaleName());
    }
}
