<?php

namespace FondOfOryx\Glue\LogIo;

use FondOfOryx\Shared\LogIo\LogIoConstants;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\SocketHandler;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Glue\LogIo\LogIoConfig getConfig()
 */
class LogIoFactory extends AbstractFactory
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    public function createLogIoHandler(): HandlerInterface
    {
        $handler = new SocketHandler(
            $this->getConfig()->getConnectionString(),
            $this->getConfig()->getLogLevel(),
        );

        $handler->setFormatter($this->createLogIoFormatter());

        return $handler;
    }

    /**
     * @return \Monolog\Formatter\FormatterInterface
     */
    protected function createLogIoFormatter(): FormatterInterface
    {
        return new LineFormatter(LogIoConstants::LINE_FORMATTER_FORMAT);
    }
}
