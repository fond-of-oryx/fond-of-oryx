<?php

namespace FondOfOryx\Yves\LogAwsCloudWatchConnector\Plugin\Handler;

use FondOfOryx\Shared\LogAwsCloudWatchConnector\AwsCloudWatchHandlerPluginTrait;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfOryx\Yves\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorFactory getFactory()
 */
class AwsCloudWatchHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use AwsCloudWatchHandlerPluginTrait;
}
