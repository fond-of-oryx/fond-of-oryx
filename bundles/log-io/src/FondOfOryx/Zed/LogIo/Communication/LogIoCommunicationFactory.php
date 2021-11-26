<?php

namespace FondOfOryx\Zed\LogIo\Communication;

use FondOfOryx\Shared\LogIo\LogIoConstants;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\SocketHandler;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\LogIo\LogIoConfig getConfig()
 */
class LogIoCommunicationFactory extends AbstractCommunicationFactory
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
