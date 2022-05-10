<?php

namespace FondOfOryx\Yves\LogLogIoConnector;

use FondOfOryx\Shared\LogLogIoConnector\LogLogIoConnectorConstants;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\SocketHandler;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Yves\LogLogIoConnector\LogLogIoConnectorConfig getConfig()
 */
class LogLogIoConnectorFactory extends AbstractFactory
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
        return new LineFormatter(LogLogIoConnectorConstants::LINE_FORMATTER_FORMAT);
    }
}
