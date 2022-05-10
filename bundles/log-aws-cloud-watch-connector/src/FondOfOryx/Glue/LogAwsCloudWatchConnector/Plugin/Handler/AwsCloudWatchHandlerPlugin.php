<?php

namespace FondOfOryx\Glue\LogAwsCloudWatchConnector\Plugin\Handler;

use FondOfOryx\Shared\LogAwsCloudWatchConnector\AwsCloudWatchHandlerPluginTrait;
use Spryker\Glue\Kernel\AbstractPlugin;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;

/**
 * @method \FondOfOryx\Glue\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorFactory getFactory()
 */
class AwsCloudWatchHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use AwsCloudWatchHandlerPluginTrait;
}
