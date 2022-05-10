<?php

namespace FondOfOryx\Zed\LogAwsCloudWatchConnector\Communication\Plugin\Handler;

use FondOfOryx\Shared\LogAwsCloudWatchConnector\AwsCloudWatchHandlerPluginTrait;
use Spryker\Shared\Log\Dependency\Plugin\LogHandlerPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\LogAwsCloudWatchConnector\Communication\LogAwsCloudWatchConnectorCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\LogAwsCloudWatchConnector\LogAwsCloudWatchConnectorConfig getConfig()
 */
class AwsCloudWatchHandlerPlugin extends AbstractPlugin implements LogHandlerPluginInterface
{
    use AwsCloudWatchHandlerPluginTrait;
}
