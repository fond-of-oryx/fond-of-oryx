<?php

namespace FondOfOryx\Yves\LogAwsCloudWatchConnector;

use FondOfOryx\Shared\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConstants;
use Spryker\Yves\Log\LogConfig as BaseLogConfig;

class LogAwsCloudWatchConnectorConfig extends BaseLogConfig
{
    /**
     * @return string
     */
    public function getAwsRegion(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_REGION, LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE);
    }

    /**
     * @return string
     */
    public function getAwsVersion(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_VERSION, LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE);
    }

    /**
     * @return string
     */
    public function getAwsKey(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_KEY, '');
    }

    /**
     * @return string
     */
    public function getAwsSecret(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_SECRET, '');
    }

    /**
     * @return string
     */
    public function getAwsLogGroupName(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_GROUP_NAME_YVES_DEFAULT_VALUE);
    }

    /**
     * @return string
     */
    public function getAwsLogStreamName(): string
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_STREAM_NAME_YVES_DEFAULT_VALUE);
    }

    /**
     * @return int
     */
    public function getAwsLogRetentionDays(): int
    {
        return (int)$this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS, LogAwsCloudWatchConnectorConstants::AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE);
    }

    /**
     * @return int
     */
    public function getAwsLogLevel(): int
    {
        return (int)$this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES, LogAwsCloudWatchConnectorConstants::AWS_LOG_LEVEL_YVES_DEFAULT_VALUE);
    }

    /**
     * @return array
     */
    public function getAwsLogTags(): array
    {
        return $this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS, LogAwsCloudWatchConnectorConstants::AWS_LOG_TAGS_DEFAULT_VALUE);
    }

    /**
     * @return int
     */
    public function getAwsLogBatchSize(): int
    {
        return (int)$this->get(LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE, LogAwsCloudWatchConnectorConstants::AWS_LOG_BATCH_SIZE_DEFAULT_VALUE);
    }
}
