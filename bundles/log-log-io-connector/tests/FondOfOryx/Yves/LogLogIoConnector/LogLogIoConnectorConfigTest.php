<?php

namespace FondOfOryx\Yves\LogLogIoConnector;

use Codeception\Test\Unit;
use FondOfOryx\Shared\LogLogIoConnector\LogLogIoConnectorConstants;
use Monolog\Logger;
use Spryker\Shared\Log\LogConstants;

class LogLogIoConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Yves\LogLogIoConnector\LogLogIoConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(LogLogIoConnectorConfig::class)
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
            LogLogIoConnectorConstants::HOST_DEFAULT,
            LogLogIoConnectorConstants::PORT_DEFAULT,
        );

        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogLogIoConnectorConstants::HOST, LogLogIoConnectorConstants::HOST_DEFAULT],
                [LogLogIoConnectorConstants::PORT, LogLogIoConnectorConstants::PORT_DEFAULT],
            )->willReturnOnConsecutiveCalls(
                LogLogIoConnectorConstants::HOST_DEFAULT,
                LogLogIoConnectorConstants::PORT_DEFAULT,
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
                [LogLogIoConnectorConstants::HOST, LogLogIoConnectorConstants::HOST_DEFAULT],
                [LogLogIoConnectorConstants::PORT, LogLogIoConnectorConstants::PORT_DEFAULT],
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
