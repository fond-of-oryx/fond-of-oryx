<?php

namespace FondOfOryx\Glue\LogFilesystemConnector;

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
            '%s/data/log/%s/Glue/application.log',
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
            '%s/data/log/%s/Glue/exception.log',
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
