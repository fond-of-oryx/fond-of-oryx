<?php

namespace FondOfOryx\Glue\LogIo;

use Codeception\Test\Unit;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;

class LogIoFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\LogIo\LogIoFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\LogIo\LogIoConfig
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

        $this->factory = new LogIoFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateGelfHandler(): void
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
