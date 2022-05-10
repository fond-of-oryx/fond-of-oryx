<?php

namespace FondOfOryx\Yves\LogSlackConnector\Plugin\Handler;

use FondOfOryx\Shared\LogSlackConnector\SlackHandlerPluginTrait;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Yves\LogSlackConnector\LogSlackConnectorFactory getFactory()
 */
class SlackHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use SlackHandlerPluginTrait;
}
