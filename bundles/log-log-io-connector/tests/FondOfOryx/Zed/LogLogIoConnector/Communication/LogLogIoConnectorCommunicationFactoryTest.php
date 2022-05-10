<?php

namespace FondOfOryx\Zed\LogLogIoConnector\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\LogLogIoConnector\LogLogIoConnectorConfig;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;

class LogLogIoConnectorCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\LogLogIoConnector\Communication\LogLogIoConnectorCommunicationFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\LogLogIoConnector\LogLogIoConnectorConfig
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

        $this->factory = new LogLogIoConnectorCommunicationFactory();
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
