<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder;

use FondOfOryx\Shared\JellyfishSalesOrder\JellyfishSalesOrderConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishSalesOrderConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->get(JellyfishSalesOrderConstants::BASE_URI, 'http://localhost');
    }

    /**
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->get(JellyfishSalesOrderConstants::TIMEOUT, 2.0);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->get(JellyfishSalesOrderConstants::USERNAME, 'jellyfish');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(JellyfishSalesOrderConstants::PASSWORD, 'jellyfish');
    }

    /**
     * @return string
     */
    public function getSystemCode(): string
    {
        return $this->get(JellyfishSalesOrderConstants::SYSTEM_CODE, '');
    }

    /**
     * @return bool
     */
    public function dryRun(): bool
    {
        return $this->get(JellyfishSalesOrderConstants::DRY_RUN, true);
    }

    /**
     * @return array<string>
     */
    public function getBlacklistedPaymentMethods(): array
    {
        return $this->get(JellyfishSalesOrderConstants::BLACKLISTED_PAYMENT_METHODS, []);
    }
}
