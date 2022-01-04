<?php

namespace FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

interface ValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer): void;
}
