<?php

namespace FondOfOryx\Glue\LogIo;

use Codeception\Test\Unit;
use FondOfOryx\Shared\LogIo\LogIoConstants;
use Monolog\Logger;
use Spryker\Shared\Log\LogConstants;

class LogIoConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\LogIo\LogIoConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(LogIoConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetConnectionStringWithDefaultValues(): void
    {
        $expectedConnectionString = sprintf(
            'tcp://%s:%d',
            LogIoConstants::HOST_DEFAULT,
            LogIoConstants::PORT_DEFAULT,
        );

        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogIoConstants::HOST, LogIoConstants::HOST_DEFAULT],
                [LogIoConstants::PORT, LogIoConstants::PORT_DEFAULT],
            )->willReturnOnConsecutiveCalls(
                LogIoConstants::HOST_DEFAULT,
                LogIoConstants::PORT_DEFAULT,
            );

        static::assertEquals($expectedConnectionString, $this->config->getConnectionString());
    }

    /**
     * @return void
     */
    public function testGetConnectionString(): void
    {
        $host = '192.168.0.1';
        $port = 5000;

        $expectedConnectionString = sprintf('tcp://%s:%d', $host, $port);

        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogIoConstants::HOST, LogIoConstants::HOST_DEFAULT],
                [LogIoConstants::PORT, LogIoConstants::PORT_DEFAULT],
            )->willReturnOnConsecutiveCalls($host, $port);

        static::assertEquals($expectedConnectionString, $this->config->getConnectionString());
    }

    /**
     * @return void
     */
    public function testGetLogLeve(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->with(LogConstants::LOG_LEVEL)
            ->willReturn(Logger::INFO);

        static::assertEquals(Logger::INFO, $this->config->getLogLevel());
    }
}
