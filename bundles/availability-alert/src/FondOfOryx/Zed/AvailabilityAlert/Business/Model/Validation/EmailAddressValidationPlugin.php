<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation;

use FondOfOryx\Zed\AvailabilityAlert\Exception\SubscriberEmailInvalidException;
use FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class EmailAddressValidationPlugin implements ValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @throws \FondOfOryx\Zed\AvailabilityAlert\Exception\SubscriberEmailInvalidException
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $availabilityAlertSubscriptionTransfer->requireSubscriber();
        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();

        if ($subscriber === null || filter_var(filter_var($subscriber->getEmail(), FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) === false) {
            throw new SubscriberEmailInvalidException(sprintf('Given e-mail address "%s" is invalid!', $subscriber->getEmail()));
        }
    }
}
