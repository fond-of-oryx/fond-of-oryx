<?php

namespace FondOfOryx\Yves\LogFilesystemConnector\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Yves\Log\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Yves\LogFilesystemConnector\LogFilesystemConnectorFactory getFactory()
 * @method \FondOfOryx\Yves\LogFilesystemConnector\LogFilesystemConnectorConfig getConfig()
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
