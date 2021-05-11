<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriberPostSavePluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class CrossEngageRegisterSubscriberPostSavePlugin extends AbstractPlugin implements AvailabilityAlertSubscriberPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function postSave(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer {
        $subscriberTransfer->setBusinessUnit($availabilityAlertSubscriberTransfer->getSubscriber()->getBusinessUnit());
        $response = $this->getFacade()->registerSubscriber($subscriberTransfer);

        return $response->getSubscriber();
    }
}
