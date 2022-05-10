<?php

namespace FondOfOryx\Glue\LogLogIoConnector;

use Codeception\Test\Unit;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;

class LogLogIoConnectorFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\LogLogIoConnector\LogLogIoConnectorFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\LogLogIoConnector\LogLogIoConnectorConfig
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogLogIoConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogLogIoConnectorFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateLogIoHandler(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getLogLevel')
            ->willReturn(Logger::ERROR);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getConnectionString')
            ->willReturn('tcp://127.0.0.1:6689');

        static::assertInstanceOf(
            SocketHandler::class,
            $this->factory->createLogIoHandler(),
        );
    }
}
