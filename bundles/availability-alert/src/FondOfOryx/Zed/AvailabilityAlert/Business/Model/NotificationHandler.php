<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class NotificationHandler implements NotificationHandlerInterface
{
    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface>
     */
    protected $notificationPlugins;

    /**
     * @param array<\FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface> $notificationPlugins
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
