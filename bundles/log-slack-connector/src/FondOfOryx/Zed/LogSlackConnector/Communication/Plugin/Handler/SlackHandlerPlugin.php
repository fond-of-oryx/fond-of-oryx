<?php

namespace FondOfOryx\Zed\LogSlackConnector\Communication\Plugin\Handler;

use FondOfOryx\Shared\LogSlackConnector\SlackHandlerPluginTrait;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\LogSlackConnector\Communication\LogSlackConnectorCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\LogSlackConnector\LogSlackConnectorConfig getConfig()
 */
class SlackHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use SlackHandlerPluginTrait;
}
