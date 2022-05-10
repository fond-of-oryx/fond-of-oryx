<?php

namespace FondOfOryx\Zed\LogSlackConnector;

use Codeception\Test\Unit;
use FondOfOryx\Shared\LogSlackConnector\LogSlackConnectorConstants;

class LogSlackConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\LogSlackConnector\LogSlackConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
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
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogSlackConnectorConstants::SLACK_USERNAME, LogSlackConnectorConstants::SLACK_USERNAME_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogSlackConnectorConstants::SLACK_USERNAME_VALUE,
            );

        static::assertEquals(LogSlackConnectorConstants::SLACK_USERNAME_VALUE, $this->config->getSlackUsername());
    }

    /**
     * @return void
     */
    public function testGetSlackChannel(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogSlackConnectorConstants::SLACK_CHANNEL, LogSlackConnectorConstants::SLACK_CHANNEL_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogSlackConnectorConstants::SLACK_CHANNEL_VALUE,
            );

        static::assertEquals(LogSlackConnectorConstants::SLACK_CHANNEL_VALUE, $this->config->getSlackChannel());
    }

    /**
     * @return void
     */
    public function testGetSlackToken(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogSlackConnectorConstants::SLACK_TOKEN, ''],
            )->willReturnOnConsecutiveCalls(
                '',
            );

        static::assertEquals('', $this->config->getSlackToken());
    }
}
