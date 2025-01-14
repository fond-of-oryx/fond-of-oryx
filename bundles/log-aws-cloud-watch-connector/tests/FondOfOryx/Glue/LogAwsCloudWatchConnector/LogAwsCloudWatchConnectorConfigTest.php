<?php

namespace FondOfOryx\Glue\LogAwsCloudWatchConnector;

use Codeception\Test\Unit;
use Exception;
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_REGION, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE, $this->config->getAwsRegion());
    }

    /**
     * @return void
     */
    public function testGetAwsVersion(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_VERSION, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE, $this->config->getAwsVersion());
    }

    /**
     * @return void
     */
    public function testGetAwsKey(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_KEY, $key);
                        $self->assertSame('', $default);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals('', $this->config->getAwsKey());
    }

    /**
     * @return void
     */
    public function testGetAwsSecret(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_SECRET, $key);
                        $self->assertSame('', $default);

                        return '';
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals('', $this->config->getAwsSecret());
    }

    /**
     * @return void
     */
    public function testGetAwsLogGroupName(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_GLUE, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_GLUE_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_GLUE_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_GLUE_DEFAULT_VALUE, $this->config->getAwsLogGroupName());
    }

    /**
     * @return void
     */
    public function testGetAwsLogStreamName(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_GLUE, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_GLUE_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_GLUE_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_GLUE_DEFAULT_VALUE, $this->config->getAwsLogStreamName());
    }

    /**
     * @return void
     */
    public function testGetAwsLogRetentionDays(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE, $this->config->getAwsLogRetentionDays());
    }

    /**
     * @return void
     */
    public function testGetAwsLogLevel(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_GLUE, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_GLUE_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_GLUE_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_GLUE_DEFAULT_VALUE, $this->config->getAwsLogLevel());
    }

    /**
     * @return void
     */
    public function testGetAwsLogTags(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE, $this->config->getAwsLogTags());
    }

    /**
     * @return void
     */
    public function testGetAwsLogBatchSize(): void
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
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE, $key);
                        $self->assertSame(LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE, $default);

                        return LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE, $this->config->getAwsLogBatchSize());
    }
}
