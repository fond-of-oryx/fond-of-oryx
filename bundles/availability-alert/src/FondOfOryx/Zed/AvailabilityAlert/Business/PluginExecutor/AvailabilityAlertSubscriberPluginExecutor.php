<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

class AvailabilityAlertSubscriberPluginExecutor implements AvailabilityAlertSubscriberPluginExecutorInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPreSavePluginInterface[]
     */
    protected $preSavePlugins;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface[]
     */
    protected $postSavePlugins;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPreSavePluginInterface[] $preSavePlugins
     * @param \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface[] $postSavePlugins
     */
    public function __construct(array $preSavePlugins, array $postSavePlugins)
    {
        $this->preSavePlugins = $preSavePlugins;
        $this->postSavePlugins = $postSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePreSavePlugins(AvailabilityAlertSubscriberTransfer $subscriberTransfer): AvailabilityAlertSubscriberTransfer
    {
        foreach ($this->preSavePlugins as $preSavePlugin) {
            $subscriberTransfer = $preSavePlugin->preSave($subscriberTransfer);
        }

        return $subscriberTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePostSavePlugins(AvailabilityAlertSubscriberTransfer $subscriberTransfer): AvailabilityAlertSubscriberTransfer
    {
        foreach ($this->postSavePlugins as $postSavePlugin) {
            $subscriberTransfer = $postSavePlugin->postSave($subscriberTransfer);
        }

        return $subscriberTransfer;
    }
}
