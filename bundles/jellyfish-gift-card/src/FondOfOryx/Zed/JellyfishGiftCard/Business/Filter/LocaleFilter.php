<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use Exception;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

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
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function fromSpySalesOrderItem(SpySalesOrderItem $spySalesOrderItem): LocaleTransfer
    {
        try {
            $localeEntity = $spySalesOrderItem->getOrder()->getLocale();

            if ($localeEntity === null) {
                return $this->createDefaultLocaleTransfer();
            }

            return (new LocaleTransfer())->fromArray($localeEntity->toArray(), true);
        } catch (Exception $e) {
            return $this->createDefaultLocaleTransfer();
        }
    }

    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function createDefaultLocaleTransfer(): LocaleTransfer
    {
        return (new LocaleTransfer())->setLocaleName($this->config->getFallbackLocaleName());
    }
}
