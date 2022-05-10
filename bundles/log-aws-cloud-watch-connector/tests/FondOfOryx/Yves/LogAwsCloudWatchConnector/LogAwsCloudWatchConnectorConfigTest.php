<?php

namespace FondOfOryx\Yves\LogAwsCloudWatchConnector;

use Codeception\Test\Unit;
use FondOfOryx\Shared\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConstants;

class LogAwsCloudWatchConnectorConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $config;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->config = $this->getMockBuilder(LogAwsCloudWatchConnectorConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetAwsRegion(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_REGION, LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE, $this->config->getAwsRegion());
    }

    /**
     * @return void
     */
    public function testGetAwsVersion(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_VERSION, LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE, $this->config->getAwsVersion());
    }

    /**
     * @return void
     */
    public function testGetAwsKey(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_KEY, ''],
            )->willReturnOnConsecutiveCalls(
                '',
            );

        static::assertEquals('', $this->config->getAwsKey());
    }

    /**
     * @return void
     */
    public function testGetAwsSecret(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_SECRET, ''],
            )->willReturnOnConsecutiveCalls(
                '',
            );

        static::assertEquals('', $this->config->getAwsSecret());
    }

    /**
     * @return void
     */
    public function testGetAwsLogGroupName(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES_DEFAULT_VALUE, $this->config->getAwsLogGroupName());
    }

    /**
     * @return void
     */
    public function testGetAwsLogStreamName(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES_DEFAULT_VALUE, $this->config->getAwsLogStreamName());
    }

    /**
     * @return void
     */
    public function testGetAwsLogRetentionDays(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS, LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE, $this->config->getAwsLogRetentionDays());
    }

    /**
     * @return void
     */
    public function testGetAwsLogLevel(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES_DEFAULT_VALUE, $this->config->getAwsLogLevel());
    }

    /**
     * @return void
     */
    public function testGetAwsLogTags(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS, LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE, $this->config->getAwsLogTags());
    }

    /**
     * @return void
     */
    public function testGetAwsLogBatchSize(): void
    {
        $this->config->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE, LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE],
            )->willReturnOnConsecutiveCalls(
                LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE,
            );

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE, $this->config->getAwsLogBatchSize());
    }
}
