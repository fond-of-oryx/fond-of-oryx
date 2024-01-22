<?php

namespace FondOfOryx\Zed\LogFilesystemConnector;

use Spryker\Shared\Log\LogConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class LogFilesystemConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getApplicationLogDestinationPath(): string
    {
        return sprintf(
            '%s/data/log/%s/Zed/application.log',
            APPLICATION_ROOT_DIR,
            APPLICATION_STORE,
        );
    }

    /**
     * @return string
     */
    public function getExceptionLogDestinationPath(): string
    {
        return sprintf(
            '%s/data/log/%s/Zed/exception.log',
            APPLICATION_ROOT_DIR,
            APPLICATION_STORE,
        );
    }

    /**
     * @return string|int
     */
    public function getLogLevel(): string|int
    {
        return $this->get(LogConstants::LOG_LEVEL);
    }

    /**
     * @return int
     */
    public function getMaxFiles(): int
    {
        return 10;
    }
}
