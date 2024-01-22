<?php

namespace FondOfOryx\Zed\LogFilesystemConnector\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\LogFilesystemConnector\LogFilesystemConnectorConfig;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use PHPUnit\Framework\MockObject\MockObject;

class LogFilesystemConnectorCommunicationFactoryTest extends Unit
{
    protected MockObject|LogFilesystemConnectorConfig $configMock;

    protected LogFilesystemConnectorCommunicationFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogFilesystemConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogFilesystemConnectorCommunicationFactory();
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
