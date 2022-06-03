<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo;

use FondOfOryx\Shared\JellyfishCreditMemo\JellyfishCreditMemoConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishCreditMemoConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    protected const DEFAULT_SALES_ORDER_ITEM_STATE_REFUNDED = 'refunded';

    /**
     * @return string
     */
    public function getSalesOrderItemStateRefunded()
    {
        return $this->get(
            JellyfishCreditMemoConstants::SALES_ORDER_ITEM_STATE_REFUNDED,
            static::DEFAULT_SALES_ORDER_ITEM_STATE_REFUNDED,
        );
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->get(JellyfishCreditMemoConstants::BASE_URI, 'http://localhost');
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->get(JellyfishCreditMemoConstants::TIMEOUT, 10.0);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->get(JellyfishCreditMemoConstants::USERNAME, 'jellyfish');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(JellyfishCreditMemoConstants::PASSWORD, 'jellyfish');
    }

    /**
     * @return string
     */
    public function getSystemCode(): string
    {
        return $this->get(JellyfishCreditMemoConstants::SYSTEM_CODE, '');
    }

    /**
     * @return bool
     */
    public function dryRun(): bool
    {
        return $this->get(JellyfishCreditMemoConstants::DRY_RUN, true);
    }
}
