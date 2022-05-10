<?php

namespace FondOfOryx\Shared\LogAwsCloudWatchConnector;

use Monolog\Logger;
use Spryker\Shared\Log\LogConstants as BaseLogConstants;

interface LogAwsCloudWatchConnectorConstants extends BaseLogConstants
{
    /**
     * @var string
     */
    public const AWS_REGION = 'AWS_REGION';

    /**
     * @var string
     */
    public const AWS_REGION_DEFAULT_VALUE = 'eu-west-1';

    /**
     * @var string
     */
    public const AWS_VERSION = 'AWS_VERSION';

    /**
     * @var string
     */
    public const AWS_VERSION_DEFAULT_VALUE = 'latest';

    /**
     * @var string
     */
    public const AWS_KEY = 'AWS_KEY';

    /**
     * @var string
     */
    public const AWS_SECRET = 'AWS_SECRET';

    /**
     * @var string
     */
    public const AWS_LOG_BATCH_SIZE = 'AWS_LOG_BATCH_SIZE';

    /**
     * @var int
     */
    public const AWS_LOG_BATCH_SIZE_DEFAULT_VALUE = 1;

    /**
     * @var string
     */
    public const AWS_LOG_TAGS = 'AWS_LOG_TAGS';

    /**
     * @var array
     */
    public const AWS_LOG_TAGS_DEFAULT_VALUE = [];

    /**
     * @var string
     */
    public const AWS_LOG_LEVEL_YVES = 'AWS_LOG_LEVEL_YVES';

    public const AWS_LOG_LEVEL_YVES_DEFAULT_VALUE = Logger::CRITICAL;

    /**
     * @var string
     */
    public const AWS_LOG_LEVEL_ZED = 'AWS_LOG_LEVEL_ZED';

    public const AWS_LOG_LEVEL_ZED_DEFAULT_VALUE = Logger::CRITICAL;

    /**
     * @var string
     */
    public const AWS_LOG_LEVEL_GLUE = 'AWS_LOG_LEVEL_GLUE';

    public const AWS_LOG_LEVEL_GLUE_DEFAULT_VALUE = Logger::CRITICAL;

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_ZED = 'AWS_LOG_GROUP_NAME_ZED';

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_ZED_DEFAULT_VALUE = 'spryker-zed';

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_YVES = 'AWS_LOG_GROUP_NAME_YVES';

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_YVES_DEFAULT_VALUE = 'spryker-yves';

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_GLUE = 'AWS_LOG_GROUP_NAME_GLUE';

    /**
     * @var string
     */
    public const AWS_LOG_GROUP_NAME_GLUE_DEFAULT_VALUE = 'spryker-glue';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_ZED = 'AWS_LOG_STREAM_NAME_ZED';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_ZED_DEFAULT_VALUE = 'ec2-instance-zed';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_YVES = 'AWS_LOG_STREAM_NAME_YVES';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_YVES_DEFAULT_VALUE = 'ec2-instance-yves';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_GLUE = 'AWS_LOG_STREAM_NAME_GLUE';

    /**
     * @var string
     */
    public const AWS_LOG_STREAM_NAME_GLUE_DEFAULT_VALUE = 'ec2-instance-glue';

    /**
     * @var string
     */
    public const AWS_LOG_RETENTION_DAYS = 'AWS_LOG_RETENTION_DAYS';

    /**
     * @var int
     */
    public const AWS_LOG_RETENTION_DAYS_DEFAULT_VALUE = 30;

    /**
     * @var string
     */
    public const AWS_SDK_PARAM_REGION = 'region';

    /**
     * @var string
     */
    public const AWS_SDK_PARAM_VERSION = 'version';

    /**
     * @var string
     */
    public const AWS_SDK_PARAM_CREDENTIALS = 'credentials';

    /**
     * @var string
     */
    public const AWS_SDK_PARAM_KEY = 'key';

    /**
     * @var string
     */
    public const AWS_SDK_PARAM_SECRET = 'secret';
}
