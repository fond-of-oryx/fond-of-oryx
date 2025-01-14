<?php

namespace FondOfOryx\Glue\LogSlackConnector;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\LogSlackConnector\LogSlackConnectorConstants;

class LogSlackConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\LogSlackConnector\LogSlackConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(LogSlackConnectorConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetSlackUsername(): void
    {
        $self = $this;

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
                        $self->assertSame(LogSlackConnectorConstants::SLACK_USERNAME, $key);
                        $self->assertSame(LogSlackConnectorConstants::SLACK_USERNAME_VALUE, $default);

                        return LogSlackConnectorConstants::SLACK_USERNAME_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogSlackConnectorConstants::SLACK_USERNAME_VALUE, $this->config->getSlackUsername());
    }

    /**
     * @return void
     */
    public function testGetSlackChannel(): void
    {
        $self = $this;

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
                        $self->assertSame(LogSlackConnectorConstants::SLACK_CHANNEL, $key);
                        $self->assertSame(LogSlackConnectorConstants::SLACK_CHANNEL_VALUE, $default);

                        return LogSlackConnectorConstants::SLACK_CHANNEL_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogSlackConnectorConstants::SLACK_CHANNEL_VALUE, $this->config->getSlackChannel());
    }

    /**
     * @return void
     */
    public function testGetSlackToken(): void
    {
        $self = $this;

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
                        $self->assertSame(LogSlackConnectorConstants::SLACK_TOKEN, $key);
                        $self->assertSame('', $default);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals('', $this->config->getSlackToken());
    }
}
