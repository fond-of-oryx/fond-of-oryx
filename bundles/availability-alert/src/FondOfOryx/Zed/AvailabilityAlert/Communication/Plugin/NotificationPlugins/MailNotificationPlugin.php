<?php
namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Plugin\NotificationPlugins;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\NotificationPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Communication\AvailabilityAlertCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface getFacade()()
 */
class MailNotificationPlugin extends AbstractPlugin implements NotificationPluginInterface
{
    public function notify(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->getFacade()->sendEmailNotification($availabilityAlertSubscriptionTransfer);
    }


}
