<?php

namespace FondOfOryx\Client\AvailabilityAlert\Validation;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

interface ValidationPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer): void;
}
