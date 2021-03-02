<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Expander;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionTransferExpanderPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory getFactory()
 */
class CrossEngageAvailabilityAlertSubscriptionTransferExpanderPlugin extends AbstractPlugin implements AvailabilityAlertSubscriptionTransferExpanderPluginInterface
{
    public function expand(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
    ): AvailabilityAlertSubscriptionTransfer {

        $availabilityAlertSubscriptionTransfer->requireSubscriber();

        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();
        $subscriber->setSubscriberIp($alertSubscriptionRequestTransfer->getSubscriberIp())
            ->setHash($this->getFactory()->getCrossEngageService()->getHash($availabilityAlertSubscriptionTransfer->getSubscriber()->getEmail()));

        $availabilityAlertSubscriptionTransfer->setSubscriber($subscriber);

        return $availabilityAlertSubscriptionTransfer;
    }

}
