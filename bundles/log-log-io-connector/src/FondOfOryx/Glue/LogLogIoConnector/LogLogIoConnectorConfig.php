<?php

namespace FondOfOryx\Glue\LogLogIoConnector;

use FondOfOryx\Shared\LogLogIoConnector\LogLogIoConnectorConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;
use Spryker\Shared\Log\LogConstants;

class LogLogIoConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return sprintf(
            'tcp://%s:%d',
            $this->get(LogLogIoConnectorConstants::HOST, LogLogIoConnectorConstants::HOST_DEFAULT),
            $this->get(LogLogIoConnectorConstants::PORT, LogLogIoConnectorConstants::PORT_DEFAULT),
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
