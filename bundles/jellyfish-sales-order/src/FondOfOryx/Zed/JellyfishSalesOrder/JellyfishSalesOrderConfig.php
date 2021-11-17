<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder;

use DateTime;
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

    /**
     * @return string
     */
    public function getExportPendingStateName(): string
    {
        return $this->get(
            JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME,
            JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT,
        );
    }

    /**
     * @return string
     */
    public function getExportEventName(): string
    {
        return $this->get(
            JellyfishSalesOrderConstants::EXPORT_EVENT_NAME,
            JellyfishSalesOrderConstants::EXPORT_EVENT_NAME_DEFAULT,
        );
    }

    /**
     * @return \DateTime
     */
    public function getMinCreatedAtForOrders(): DateTime
    {
        $minCreatedAtForOrders = new DateTime();

        $maxOrderAgeInDays = $this->get(
            JellyfishSalesOrderConstants::MAX_ORDER_AGE_IN_DAYS,
            JellyfishSalesOrderConstants::MAX_ORDER_AGE_IN_DAYS_DEFAULT,
        );

        if (!is_int($maxOrderAgeInDays) && $maxOrderAgeInDays > 0) {
            $maxOrderAgeInDays = JellyfishSalesOrderConstants::MAX_ORDER_AGE_IN_DAYS_DEFAULT;
        }

        $minCreatedAtForOrders->modify(sprintf('-%s days', $maxOrderAgeInDays));

        return $minCreatedAtForOrders;
    }
}
