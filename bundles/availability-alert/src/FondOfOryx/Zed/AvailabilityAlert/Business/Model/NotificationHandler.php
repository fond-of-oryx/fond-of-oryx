<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class NotificationHandler implements NotificationHandlerInterface
{
    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\NotificationPluginInterface>
     */
    protected $notificationPlugins;

    /**
     * @param array<\FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\NotificationPluginInterface> $notificationPlugins
     */
    public function __construct(array $notificationPlugins)
    {
        $this->notificationPlugins = $notificationPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function execute(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        foreach ($this->notificationPlugins as $notificationPlugin) {
            $notificationPlugin->notify($availabilityAlertSubscriptionTransfer);
        }
    }
}
