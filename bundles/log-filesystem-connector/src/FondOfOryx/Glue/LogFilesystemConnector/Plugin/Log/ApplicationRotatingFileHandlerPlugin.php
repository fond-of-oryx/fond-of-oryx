<?php

namespace FondOfOryx\Glue\LogFilesystemConnector\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Glue\Log\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Glue\LogFilesystemConnector\LogFilesystemConnectorFactory getFactory()
 * @method \FondOfOryx\Glue\LogFilesystemConnector\LogFilesystemConnectorConfig getConfig()
 */
class ApplicationRotatingFileHandlerPlugin extends AbstractHandlerPlugin
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function getHandler(): HandlerInterface
    {
        if (!$this->handler) {
            $this->handler = $this->getFactory()->createApplicationRotatingFileHandler();
        }

        return $this->handler;
    }
}
