<?php

namespace FondOfOryx\Glue\LogLogIoConnector\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Glue\Log\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @method \FondOfOryx\Yves\LogLogIoConnector\LogLogIoConnectorFactory getFactory()
 */
class LogIoHandlerPlugin extends AbstractHandlerPlugin
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function getHandler(): HandlerInterface
    {
        if (!$this->handler) {
            $this->handler = $this->getFactory()->createLogIoHandler();
        }

        return $this->handler;
    }
}
