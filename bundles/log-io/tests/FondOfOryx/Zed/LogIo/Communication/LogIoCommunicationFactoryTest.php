<?php

namespace FondOfOryx\Zed\LogIo\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\LogIo\LogIoConfig;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;

class LogIoCommunicationFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\LogIo\Communication\LogIoCommunicationFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\LogIo\LogIoConfig
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogIoConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogIoCommunicationFactory();
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
