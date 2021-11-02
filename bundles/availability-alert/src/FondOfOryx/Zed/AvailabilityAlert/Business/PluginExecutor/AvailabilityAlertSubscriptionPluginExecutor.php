<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertSubscriptionPluginExecutor implements AvailabilityAlertSubscriptionPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionPreSavePluginInterface>
     */
    protected $preSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionPostSavePluginInterface>
     */
    protected $postSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionPreSavePluginInterface> $preSavePlugins
     * @param array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionPostSavePluginInterface> $postSavePlugins
     */
    public function __construct(array $preSavePlugins, array $postSavePlugins)
    {
        $this->preSavePlugins = $preSavePlugins;
        $this->postSavePlugins = $postSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function executePreSavePlugins(AvailabilityAlertSubscriptionTransfer $subscriptionTransfer): AvailabilityAlertSubscriptionTransfer
    {
        foreach ($this->preSavePlugins as $preSavePlugin) {
            $subscriptionTransfer = $preSavePlugin->preSave($subscriptionTransfer);
        }

        return $subscriptionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function executePostSavePlugins(AvailabilityAlertSubscriptionTransfer $subscriptionTransfer): AvailabilityAlertSubscriptionTransfer
    {
        foreach ($this->postSavePlugins as $postSavePlugin) {
            $subscriptionTransfer = $postSavePlugin->postSave($subscriptionTransfer);
        }

        return $subscriptionTransfer;
    }
}
