<?php

namespace FondOfOryx\Client\AvailabilityAlert\Validation;

use FondOfOryx\Client\AvailabilityAlert\Exception\SubscriberEmailInvalidException;
use FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin\ValidationPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class EmailAddressValidationPlugin implements ValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @throws \FondOfOryx\Client\AvailabilityAlert\Exception\SubscriberEmailInvalidException
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer): void
    {
        $email = $availabilityAlertSubscriptionRequestTransfer->getEmail();
        if (filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) === false) {
            throw new SubscriberEmailInvalidException(sprintf('Given e-mail address "%s" is invalid!', $email));
        }
    }
}
