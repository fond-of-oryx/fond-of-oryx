<?php

namespace FondOfOryx\Zed\LogFilesystemConnector\Communication\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Zed\Log\Communication\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\LogFilesystemConnector\Communication\LogFilesystemConnectorCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\LogFilesystemConnector\LogFilesystemConnectorConfig getConfig()
 */
class ExceptionRotatingFileHandlerPlugin extends AbstractHandlerPlugin
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function getHandler(): HandlerInterface
    {
        if (!$this->handler) {
            $this->handler = $this->getFactory()->createExceptionRotatingFileHandler();
        }

        return $this->handler;
    }
}
