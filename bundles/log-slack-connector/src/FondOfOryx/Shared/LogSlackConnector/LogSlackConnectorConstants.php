<?php

namespace FondOfOryx\Shared\LogSlackConnector;

use Spryker\Shared\Log\LogConstants as BaseLogConstants;

interface LogSlackConnectorConstants extends BaseLogConstants
{
    /**
     * Specification:
     * - Username for slack.
     *
     * @api
     *
     * @var string
     */
    public const SLACK_USERNAME = 'SLACK_USERNAME';

    /**
     * Specification:
     * - Default value for slack username.
     *
     * @api
     *
     * @var string
     */
    public const SLACK_USERNAME_VALUE = 'spryker';

    /**
     * Specification:
     * - Slack channel where logs send to.
     *
     * @api
     *
     * @var string
     */
    public const SLACK_CHANNEL = 'SLACK_CHANNEL';

    /**
     * Specification:
     * - Default value for slack channel.
     *
     * @api
     *
     * @var string
     */
    public const SLACK_CHANNEL_VALUE = '#spryker';

    /**
     * Specification:
     * - Token for slack.
     *
     * @api
     *
     * @var string
     */
    public const SLACK_TOKEN = 'SLACK_TOKEN';
}
