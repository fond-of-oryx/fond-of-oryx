<?php

namespace FondOfOryx\Yves\LogAwsCloudWatchConnector;

use Codeception\Test\Unit;
use FondOfOryx\Shared\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConstants;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Logger;

class LogAwsCloudWatchConnectorFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Yves\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorFactory
     */
    protected $factory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConfig
     */
    protected $configMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(LogAwsCloudWatchConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new LogAwsCloudWatchConnectorFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateCloudWatchHandler(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogLevel')
            ->willReturn(Logger::ERROR);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogGroupName')
            ->willReturn('');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogStreamName')
            ->willReturn('');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogRetentionDays')
            ->willReturn(1);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogBatchSize')
            ->willReturn(1);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsLogTags')
            ->willReturn([]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsVersion')
            ->willReturn(LogAwsCloudWatchConnectorConstants::AWS_VERSION_DEFAULT_VALUE);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getAwsRegion')
            ->willReturn(LogAwsCloudWatchConnectorConstants::AWS_REGION_DEFAULT_VALUE);

        static::assertInstanceOf(
            CloudWatch::class,
            $this->factory->createCloudWatchHandler(),
        );
    }
}
