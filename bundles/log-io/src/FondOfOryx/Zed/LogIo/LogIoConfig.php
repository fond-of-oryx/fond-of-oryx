<?php

namespace FondOfOryx\Zed\LogIo;

use FondOfOryx\Shared\LogIo\LogIoConstants;
use Spryker\Shared\Log\LogConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class LogIoConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return sprintf(
            'tcp://%s:%d',
            $this->get(LogIoConstants::HOST, LogIoConstants::HOST_DEFAULT),
            $this->get(LogIoConstants::PORT, LogIoConstants::PORT_DEFAULT),
        );
    }

    /**
     * @phpstan-return 100|200|250|300|400|500|550|600|non-empty-string
     *
     * @return string|int
     */
    public function getLogLevel()
    {
        return $this->get(LogConstants::LOG_LEVEL);
    }
}
