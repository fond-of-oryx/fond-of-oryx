<?php

namespace FondOfOryx\Glue\LogSlackConnector;

use Monolog\Handler\SlackHandler;
use Spryker\Glue\Log\LogFactory as BaseLogFactory;

/**
 * @method \FondOfOryx\Glue\LogSlackConnector\LogSlackConnectorConfig getConfig()
 */
class LogSlackConnectorFactory extends BaseLogFactory
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
