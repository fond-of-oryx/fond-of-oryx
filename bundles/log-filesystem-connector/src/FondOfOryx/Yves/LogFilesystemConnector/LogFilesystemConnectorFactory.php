<?php

namespace FondOfOryx\Yves\LogFilesystemConnector;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Yves\LogFilesystemConnector\LogFilesystemConnectorConfig getConfig()
 */
class LogFilesystemConnectorFactory extends AbstractFactory
{
    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    public function createApplicationRotatingFileHandler(): HandlerInterface
    {
        return $this->createRotatingFileHandler(
            $this->getConfig()->getApplicationLogDestinationPath(),
            $this->getConfig()->getLogLevel(),
        );
    }

    /**
     * @return \Monolog\Handler\HandlerInterface
     */
    public function createExceptionRotatingFileHandler(): HandlerInterface
    {
        return $this->createRotatingFileHandler(
            $this->getConfig()->getExceptionLogDestinationPath(),
            Logger::ERROR,
        );
    }

    /**
     * @param string $filename
     * @param string|int $logLevel
     *
     * @return \Monolog\Handler\HandlerInterface
     */
    protected function createRotatingFileHandler(
        string $filename,
        int|string $logLevel
    ): HandlerInterface {
        $handler = new RotatingFileHandler(
            $filename,
            $this->getConfig()->getMaxFiles(),
            $logLevel,
        );

        $handler->setFormatter($this->createLogstashFormatter());

        return $handler;
    }

    /**
     * @return \Monolog\Formatter\FormatterInterface
     */
    protected function createLogstashFormatter(): FormatterInterface
    {
        return new LogstashFormatter(APPLICATION);
    }
}
