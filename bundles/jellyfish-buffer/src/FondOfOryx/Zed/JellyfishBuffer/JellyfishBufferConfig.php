<?php

namespace FondOfOryx\Zed\JellyfishBuffer;

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
}
