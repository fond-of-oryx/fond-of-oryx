<?php

namespace FondOfOryx\Yves\LogIo\Plugin\Log;

use Monolog\Handler\HandlerInterface;
use Spryker\Yves\Log\Plugin\Handler\AbstractHandlerPlugin;

/**
 * @method \FondOfOryx\Yves\LogIo\LogIoFactory getFactory()
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
