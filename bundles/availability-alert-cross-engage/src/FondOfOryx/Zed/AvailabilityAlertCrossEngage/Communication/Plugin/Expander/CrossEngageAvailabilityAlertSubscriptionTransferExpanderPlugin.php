<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Expander;

use FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Expander\AvailabilityAlertSubscriptionTransferExpanderPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class CrossEngageAvailabilityAlertSubscriptionTransferExpanderPlugin extends AbstractPlugin implements AvailabilityAlertSubscriptionTransferExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        $availabilityAlertSubscriptionTransfer->requireSubscriber();

        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();
        $subscriber->setSubscriberIp($alertSubscriptionRequestTransfer->getSubscriberIp())
            ->setIsActive($this->getConfig()->getDefaultSubscriberActivationState())
            ->setKey($this->getFacade()->generateKey($subscriber->getEmail()))
            ->setHash($this->getFactory()->getCrossEngageService()->getHash($subscriber->getEmail()));

        $availabilityAlertSubscriptionTransfer->setSubscriber($subscriber);

        return $availabilityAlertSubscriptionTransfer;
    }
}
