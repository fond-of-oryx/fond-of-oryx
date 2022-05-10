<?php

namespace FondOfOryx\Zed\LogLogIoConnector\Communication\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Zed\Log\Communication\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @method \FondOfOryx\Zed\LogLogIoConnector\Communication\LogLogIoConnectorCommunicationFactory getFactory()
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
