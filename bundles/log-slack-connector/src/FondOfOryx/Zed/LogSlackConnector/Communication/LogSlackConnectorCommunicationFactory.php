<?php

namespace FondOfOryx\Zed\LogSlackConnector\Communication;

use Monolog\Handler\SlackHandler;
use Spryker\Zed\Log\Communication\LogCommunicationFactory as BaseLogCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\LogSlackConnector\LogSlackConnectorConfig getConfig()
 */
class LogSlackConnectorCommunicationFactory extends BaseLogCommunicationFactory
{
    /**
     * @return \Monolog\Handler\SlackHandler
     */
    public function createSlackHandler(): SlackHandler
    {
        return new SlackHandler(
            $this->getConfig()->getSlackToken(),
            $this->getConfig()->getSlackChannel(),
            $this->getConfig()->getSlackUsername(),
            true,
            null,
            $this->getConfig()->getLogLevel(), // @phpstan-ignore-line
        );
    }
}
