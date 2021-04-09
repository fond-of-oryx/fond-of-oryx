<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business;

use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageBusinessFactory getFactory()
 */
class AvailabilityAlertCrossEngageFacade extends AbstractFacade implements AvailabilityAlertCrossEngageFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer
     */
    public function registerSubscriber(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer
    ): AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer {
        return $this->getFactory()->createRegisterSubscriberHandler()->registerSubscriber($subscriberTransfer);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function generateKey(string $string): string
    {
        return $this->getFactory()->createKeyGenerator()->generate($string);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function sendNotification(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->getFactory()->createNotificationHandler()->sendSubscription($availabilityAlertSubscriptionTransfer);
    }
}
