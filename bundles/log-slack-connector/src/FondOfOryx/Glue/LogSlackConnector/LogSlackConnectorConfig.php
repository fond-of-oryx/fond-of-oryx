<?php

namespace FondOfOryx\Glue\LogSlackConnector;

use FondOfOryx\Shared\LogSlackConnector\LogSlackConnectorConstants;
use Spryker\Glue\Log\LogConfig as BaseLogConfig;

class LogSlackConnectorConfig extends BaseLogConfig
{
    /**
     * @return string
     */
    public function getSlackUsername(): string
    {
        return $this->get(LogSlackConnectorConstants::SLACK_USERNAME, LogSlackConnectorConstants::SLACK_USERNAME_VALUE);
    }

    /**
     * @return string
     */
    public function getSlackChannel(): string
    {
        return $this->get(LogSlackConnectorConstants::SLACK_CHANNEL, LogSlackConnectorConstants::SLACK_CHANNEL_VALUE);
    }

    /**
     * @return string
     */
    public function getSlackToken(): string
    {
        return $this->get(LogSlackConnectorConstants::SLACK_TOKEN, '');
    }
}
