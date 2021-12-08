<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business;

use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertCrossEngageFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer
     */
    public function registerSubscriber(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer
    ): AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer
     */
    public function sendSubscribedToBackInStockEvent(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;

    /**
     * @param string $string
     *
     * @return string
     */
    public function generateKey(string $string): string;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function sendNotification(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
