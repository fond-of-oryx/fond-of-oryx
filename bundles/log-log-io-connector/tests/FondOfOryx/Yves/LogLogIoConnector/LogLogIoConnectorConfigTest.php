<?php

namespace FondOfOryx\Yves\LogLogIoConnector;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $expectedConnectionString = sprintf(
            'tcp://%s:%d',
            LogLogIoConnectorConstants::HOST_DEFAULT,
            LogLogIoConnectorConstants::PORT_DEFAULT,
        );

        $callCount = $this->atLeastOnce();
        $this->config->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function ($key, $default = null) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(LogLogIoConnectorConstants::HOST, $key);
                        $self->assertSame(LogLogIoConnectorConstants::HOST_DEFAULT, $default);

                        return LogLogIoConnectorConstants::HOST_DEFAULT;
                    case 2:
                        $self->assertSame(LogLogIoConnectorConstants::PORT, $key);
                        $self->assertSame(LogLogIoConnectorConstants::PORT_DEFAULT, $default);

                        return LogLogIoConnectorConstants::PORT_DEFAULT;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals($expectedConnectionString, $this->config->getConnectionString());
    }

    /**
     * @return void
     */
    public function testGetConnectionString(): void
    {
        $self = $this;

        $host = '192.168.0.1';
        $port = 5000;

        $expectedConnectionString = sprintf('tcp://%s:%d', $host, $port);

        $callCount = $this->atLeastOnce();
        $this->config->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function ($key, $default = null) use ($self, $callCount, $host, $port) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(LogLogIoConnectorConstants::HOST, $key);
                        $self->assertSame(LogLogIoConnectorConstants::HOST_DEFAULT, $default);

                        return $host;
                    case 2:
                        $self->assertSame(LogLogIoConnectorConstants::PORT, $key);
                        $self->assertSame(LogLogIoConnectorConstants::PORT_DEFAULT, $default);

                        return $port;
                }

                throw new Exception('Unexpected call count');
            });

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
