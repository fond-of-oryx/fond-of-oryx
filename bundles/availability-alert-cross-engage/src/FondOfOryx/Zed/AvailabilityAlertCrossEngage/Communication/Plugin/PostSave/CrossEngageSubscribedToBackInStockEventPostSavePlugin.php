<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionPostSavePluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class CrossEngageSubscribedToBackInStockEventPostSavePlugin extends AbstractPlugin implements AvailabilityAlertSubscriptionPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $subscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function postSave(AvailabilityAlertSubscriptionTransfer $subscriptionTransfer): AvailabilityAlertSubscriptionTransfer
    {
        return $this->getFacade()->sendSubscribedToBackInStockEvent($subscriptionTransfer)->getSubscription();
    }
}
