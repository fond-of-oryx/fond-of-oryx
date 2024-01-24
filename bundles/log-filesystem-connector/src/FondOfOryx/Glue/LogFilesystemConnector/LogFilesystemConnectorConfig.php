<?php

namespace FondOfOryx\Glue\LogFilesystemConnector;

use FondOfOryx\Shared\LogFilesystemConnector\LogFilesystemConnectorConstants;
use Spryker\Glue\Kernel\AbstractBundleConfig;
use Spryker\Shared\Log\LogConstants;

class LogFilesystemConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getApplicationLogDestinationPath(): string
    {
        return sprintf(
            '%s/data/logs/%s/Glue/application.log',
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
            '%s/data/logs/%s/Glue/exception.log',
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
        return $this->get(
            LogFilesystemConnectorConstants::MAX_FILES,
            LogFilesystemConnectorConstants::MAX_FILES_DEFAULT,
        );
    }
}
