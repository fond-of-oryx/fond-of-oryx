<?php

namespace FondOfOryx\Glue\LogSlackConnector\Plugin\Handler;

use FondOfOryx\Shared\LogSlackConnector\SlackHandlerPluginTrait;
use Spryker\Glue\Kernel\AbstractPlugin;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;

/**
 * @method \FondOfOryx\Glue\LogSlackConnector\LogSlackConnectorFactory getFactory()
 */
class SlackHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use SlackHandlerPluginTrait;
}
