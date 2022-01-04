<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertSubscriberPluginExecutor implements AvailabilityAlertSubscriberPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface>
     */
    protected $preSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface>
     */
    protected $postSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PreSave\AvailabilityAlertSubscriberPreSavePluginInterface> $preSavePlugins
     * @param array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\PostSave\AvailabilityAlertSubscriberPostSavePluginInterface> $postSavePlugins
     */
    public function __construct(array $preSavePlugins, array $postSavePlugins)
    {
        $this->preSavePlugins = $preSavePlugins;
        $this->postSavePlugins = $postSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePreSavePlugins(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer {
        foreach ($this->preSavePlugins as $preSavePlugin) {
            $subscriberTransfer = $preSavePlugin->preSave($subscriberTransfer, $availabilityAlertSubscriberTransfer);
        }

        return $subscriberTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePostSavePlugins(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer {
        foreach ($this->postSavePlugins as $postSavePlugin) {
            $subscriberTransfer = $postSavePlugin->postSave($subscriberTransfer, $availabilityAlertSubscriberTransfer);
        }

        return $subscriberTransfer;
    }
}
