<?php

namespace FondOfOryx\Yves\LogFilesystemConnector;

use Codeception\Test\Unit;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use PHPUnit\Framework\MockObject\MockObject;

class LogFilesystemConnectorFactoryTest extends Unit
{
    protected MockObject|LogFilesystemConnectorConfig $configMock;

    protected LogFilesystemConnectorFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogFilesystemConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogFilesystemConnectorFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateApplicationRotatingFileHandler(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getApplicationLogDestinationPath')
            ->willReturn('/var/log/application.log');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getLogLevel')
            ->willReturn(Logger::INFO);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxFiles')
            ->willReturn(10);

        $handler = $this->factory->createApplicationRotatingFileHandler();

        static::assertInstanceOf(
            RotatingFileHandler::class,
            $handler,
        );

        static::assertEquals(
            Logger::INFO,
            $handler->getLevel(),
        );
    }

    /**
     * @return void
     */
    public function testCreateExceptionRotatingFileHandler(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getExceptionLogDestinationPath')
            ->willReturn('/var/log/exception.log');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getMaxFiles')
            ->willReturn(10);

        $handler = $this->factory->createExceptionRotatingFileHandler();

        static::assertInstanceOf(
            RotatingFileHandler::class,
            $handler,
        );

        static::assertEquals(
            Logger::ERROR,
            $handler->getLevel(),
        );
    }
}
