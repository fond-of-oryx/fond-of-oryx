<?php

namespace FondOfOryx\Zed\JellyfishBuffer;

use FondOfOryx\Shared\JellyfishBuffer\JellyfishBufferConstants;
use FondOfOryx\Shared\JellyfishSalesOrder\JellyfishSalesOrderConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class JellyfishBufferConfig extends AbstractBundleConfig
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
        return $this->get(JellyfishSalesOrderConstants::TIMEOUT, 10.0);
    }

    /**
     * @return bool
     */
    public function getDryRun(): bool
    {
        return $this->get(JellyfishSalesOrderConstants::DRY_RUN, true);
    }

    /**
     * @return int
     */
    public function getDefaultExportUserId(): int
    {
        return $this->get(JellyfishBufferConstants::DEFAULT_EXPORT_USER_ID, JellyfishBufferConstants::DEFAULT_EXPORT_USER_ID_DEFAULT_VALUE);
    }
}
