<?php

namespace FondOfOryx\Yves\LogSlackConnector;

use Monolog\Handler\SlackHandler;
use Spryker\Yves\Log\LogFactory as BaseLogFactory;

/**
 * @method \FondOfOryx\Yves\LogSlackConnector\LogSlackConnectorConfig getConfig()
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
